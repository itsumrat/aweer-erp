<?php

namespace App\Http\Controllers;

use App\CashPurchase;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use App\PurchaseOrderWiseItem;
use App\FOCItems;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class CashPurchaseController extends Controller
{
    private $root = 'purchase/cash/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = DB::table('stores')->get();
        $data = [
            'stores'=>$stores 
        ];
        return view($this->root.'index',$data);
    }

    public function purchaseOrderTableData(Request $request){
        $store_id = $request->store_id;
        $date_range = $request->date_range;

       $purchase = Purchase::with(['vendor', 'purchase_items', 'purchase_items.item', 'purchase_items.item.prices', 'foc_items','foc_items.item']);

       if ($store_id != 0) {
           $purchase = $purchase->where('location_id', $store_id);
       }
       if($date_range != null){
        $date_range = explode('-', $date_range);
        $start_date = Carbon::parse($date_range[0])->format('Y-m-d H:i:s');
    
        $end_date = Carbon::parse($date_range[1])->format('Y-m-d H:i:s');
        $purchase = $purchase->where('created_at','>=', $start_date);
        $purchase = $purchase->where('created_at','<=', $end_date);
       }

       $purchase = $purchase->get();

        return Datatables::of($purchase)
                ->addIndexColumn()
                ->editColumn('vendor_invoice', function(Purchase $req){
                    return 'NA';
                })
                ->editColumn('grand_total', function(Purchase $req){
                    $items = $req->purchase_items;
                    $total = 0;
                    if(!empty($items)){
                        foreach ($items as $key => $item) {
                            $single_item_total =  ($item->quantity * $item->item->prices->final_cost);
                            $single_item_total = $single_item_total - ($single_item_total * $item->discount)/100;
                            $total += $single_item_total;
                        }
                    }

                    $total = $total - ($total * $req->discount)/100;
                    $total = $total + ($total * $req->tax)/100;

                    return $total;
                })
                ->editColumn('vendor', function(Purchase $req){
                    return $req->vendor->name;
                })
                ->editColumn('tax', function(Purchase $req){
                    return $req->tax . ' %';
                })
                ->editColumn('discount', function(Purchase $req){
                    return $req->discount .' %';
                })
                ->editColumn('foc_items', function(Purchase $req){
                    $items = $req->foc_items;
                    $item_list = '';
                    foreach ($items as $key => $item) {
                        $item_list .= $item->item->name .',';
                    }
                    return $item_list;
                })
                ->editColumn('status', function(Purchase $req){
                    if($req->status == 0){
                        return 'Draft';
                    }
                    if($req->status == 1){
                        return 'Final';
                    }
                })
                ->editColumn('action', function(Purchase $req){
                    return '<div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle btn-action" type="button" id="itemActionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="itemActionDropdown">
                                                        <a class="dropdown-item" href="/purchase/'.$req->id.'">View</a>
                                                        <a class="dropdown-item" href="/purchase/'.$req->id.'/edit">Edit</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#statusUpdateModal">Update Status</a>
                                                        <a class="dropdown-item" href="make-transfer.php">Make Transfer</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#requisitionDelModal">Delete</a>
                                                    </div>
                                                </div>';
                })
                ->make();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->root . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'date' => 'required',
            'requisition_date' => 'required',
            'vendor_confirm_date' => 'required',
            'shipping_date' => 'required',
            'reference' => 'required',
            'location_id' => 'required',
        ]);

        $req = new Purchase();
        $file_name = '';

        if($request->file('document') != null){
        $fileName = time().'.'.$request->document->extension();  
   
        $request->document->move(public_path('uploads/purchase_document'), $fileName);
        $file_name = 'uploads/purchase_document/'.$fileName;
        }
        

        $req->date = $request->date;
        $req->requisition_date = $request->requisition_date;
        $req->vendor_confirm_date = $request->vendor_confirm_date;
        $req->shipping_date = $request->shipping_date;
        $req->reference = $request->reference;
        $req->location_id = $request->location_id;
        $req->status = $request->status;
        $req->document_file = $file_name;
        $req->is_foc = $request->is_foc;
        $req->vendor_id = $request->vendor_id;
        $req->discount = $request->discount;
        $req->tax = $request->tax;
        $req->note = $request->note;
        $req->user_id = \Auth::id();
        if (isset($request->foc_items)) {
            $req->is_foc = true;
        }else{
            $req->is_foc = false;
        }
        if($req->save()){
            $items = $request->purchase_order_items;
            foreach ($items as $item) {
                $req_item = new PurchaseOrderWiseItem();
                $req_item->purchase_id = $req->id;
                $req_item->item_id = $item['id'];
                $req_item->location_id = $request->location_id;
                $req_item->quantity = $item['quantity'];
                $req_item->cost = $item['cost'];
                $req_item->discount = $item['discount'];
                $req_item->save();
            }
            if(isset($request->foc_items)){
            $items = $request->foc_items;
            foreach ($items as $item) {
                $req_item = new FOCItems();
                $req_item->purchase_id = $req->id;//May Cause Error
                $req_item->item_id = $item['id'];
                $req_item->quantity = $item['quantity'];
                $req_item->save();

            }
            }
            return redirect()->back()->with('success', 'Added Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase = Purchase::with(['vendor', 'purchase_items','purchase_items.item', 'purchase_items.item.prices', 'foc_items', 'foc_items.item', 'location'])->where('id', $id)->first();
        $data = [
            'purchase' => $purchase
        ];


        // dd($data);
        return view($this->root . 'show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = Purchase::where('id', $id)->first();
        $data = [

            'purchase' => $purchase
        ];
        return view($this->root . 'edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'requisition_date' => 'required',
            'vendor_confirm_date' => 'required',
            'shipping_date' => 'required',
            'reference' => 'required',
            'location_id' => 'required',
        ]);

        $req = Purchase::find($id);
        $file_name = '';

        if($request->file('document') != null){
        $fileName = time().'.'.$request->document->extension();  
   
        $request->document->move(public_path('uploads/purchase_document'), $fileName);
        $file_name = 'uploads/purchase_document/'.$fileName;
        }
        

        $req->date = $request->date;
        $req->requisition_date = $request->requisition_date;
        $req->vendor_confirm_date = $request->vendor_confirm_date;
        $req->shipping_date = $request->shipping_date;
        $req->reference = $request->reference;
        $req->location_id = $request->location_id;
        $req->status = $request->status;
        $req->document_file = $file_name;
        $req->is_foc = $request->is_foc;
        $req->vendor_id = $request->vendor_id;
        $req->discount = $request->discount;
        $req->tax = $request->tax;
        $req->note = $request->note;
        if (isset($request->foc_items)) {
            $req->is_foc = true;
        }else{
            $req->is_foc = false;
        }
        if($req->save()){
            $items = $request->purchase_order_items;
            PurchaseOrderWiseItem::where('purchase_id',$id)->delete();
            foreach ($items as $item) {
                $req_item = new PurchaseOrderWiseItem();
                $req_item->purchase_id = $id;
                $req_item->item_id = $item['id'];
                $req_item->quantity = $item['quantity'];
                $req_item->discount = $item['discount'];
                $req_item->save();
            }
            if(isset($request->foc_items)){
            $items = $request->foc_items;
            FOCItems::where('purchase_id', $id)->delete();
            foreach ($items as $item) {
                $req_item = new FOCItems();
                $req_item->purchase_id = $id;
                $req_item->item_id = $item['id'];
                $req_item->quantity = $item['quantity'];
                $req_item->save();

            }
            }
            return redirect()->back()->with('success', 'Updated Successfully!');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }


    public function purchaseItemsById(Request $request){
        $id = $request->id;

        $purchase = Purchase::with(['purchase_items', 'purchase_items.item', 'purchase_items.item.prices', 'foc_items', 'foc_items.item', 'foc_items.item.prices'])->where('id', $id)->first();
        return response()->json($purchase);
    }

}
