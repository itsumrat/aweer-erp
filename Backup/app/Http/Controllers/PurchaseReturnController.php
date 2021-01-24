<?php

namespace App\Http\Controllers;

use App\PurchaseReturn;
use App\PurchaseReturnItems;
use App\VendorTransaction;
use DataTables;
use Heplpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PurchaseReturnController extends Controller
{
    private $root = 'return/purchase/';
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
        return view($this->root . 'index', $data);
    }


    public function purchaseReturnData(Request $request){
       $store_id = $request->store_id;
       $purchase = PurchaseReturn::with(['vendor', 'purchase_items', 'purchase_items.item', 'purchase_items.item.prices']);


       if ($store_id != 0) {
           $purchase = $purchase->where('location_id', $store_id);
       }

       $purchase = $purchase->get();

        return Datatables::of($purchase)
                ->addIndexColumn()
                ->editColumn('location', function(PurchaseReturn $req){
                    return 'NA';
                })
                ->editColumn('grand_total', function(PurchaseReturn $req){
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
                ->editColumn('vendor', function(PurchaseReturn $req){
                    return $req->vendor->name;
                })

                ->editColumn('status', function(PurchaseReturn $req){
                    if($req->status == 0){
                        return 'Draft';
                    }
                    if($req->status == 1){
                        return 'Final';
                    }
                })
                ->editColumn('action', function(PurchaseReturn $req){
                    return '<div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle btn-action" type="button" id="itemActionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="itemActionDropdown">
                                                        <a class="dropdown-item" href="/purchase_return/'.$req->id.'">View</a>
                                                        <a class="dropdown-item" href="/purchase_return/'.$req->id.'/edit">Edit</a>
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
            'reference' => [
                'required', 
                new \App\Rules\PurchaseReturn(
                    $request->location_id,
                    $request->vendor_id,
                    $request->purchase_return_items
                )
            ],
            'location_id' => 'required'            
        ]);
        
        $req = new PurchaseReturn();
        $file_name = '';
        if($request->file('document') != null){
        $fileName = time().'.'.$request->document->extension();  
   
        $request->document->move(public_path('uploads/purchase_return_document'), $fileName);
        $file_name = 'uploads/purchase_return_document/'.$fileName;
        }
        

        $req->date = $request->date;
        $req->reference = $request->reference;
        $req->location_id = $request->location_id;
        $req->status = $request->status;
        $req->document_file = $file_name;
        $req->vendor_id = $request->vendor_id;
        $req->note = $request->note;
        $req->grand_total = $request->grand_total;
        $req->user_id = \Auth::id();

        if($req->save()){
            // vendor transaction save to db
            $vendorTrans = new VendorTransaction;
            $vendorTrans->date = $request->date;
            $vendorTrans->reference = $request->reference;
            $vendorTrans->location_id = $request->location_id;
            $vendorTrans->status = $request->status;
            $vendorTrans->document_file = $file_name;
            $vendorTrans->vendor_id = $request->vendor_id;
            $vendorTrans->note = $request->note;
            $vendorTrans->credit = $request->grand_total;
            $vendorTrans->user_id = \Auth::id();
            $vendorTrans->save();
            // end vendor transaction save to db
            
            $items = $request->purchase_return_items;
            $data = array(); //code by mostofa
            $vendor_data = array(); //code by mostofa
            foreach ($items as $item) {
                $req_item = new PurchaseReturnItems();
                $req_item->purchase_return_id = $req->id;//May Cause Error
                $req_item->location_id = $request->location_id;
                $req_item->item_id = $item['id'];
                $req_item->quantity = $item['quantity'];
                $req_item->save();
                //coded by mostofa
                //item_id, location_id,op_type=1,quantity,end_point=3
                $push_data = [$req_item->item_id,$req->location_id,2,$req_item->quantity,10];
                $push_vendor_data=[$req_item->item_id,$req->vendor_id,2,$req_item->quantity,10];
                array_push($data, $push_data);
                array_push($vendor_data, $push_vendor_data);
            }

            $operation = \Helpers::callStockInOut($data, $vendor_data);

            if($operation['result'] > 0){
                return redirect()->back()->with('success', 'Added Successfully!');
            }else{
                return redirect()->back()->with('failed', $operation['msg']);
            }
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
