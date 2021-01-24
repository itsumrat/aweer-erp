<?php

namespace App\Http\Controllers;

use Auth;
use App\Tax;
use Helpers;
use App\Item;
use DataTables;
use App\PaidGrn;
use App\Purchase;
use App\UnPaidGrn;
use App\LpoReceive;
use App\ProductPricing;
use App\VendorTransaction;
use Illuminate\Http\Request;
use App\PurchaseOrderWiseItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LPOReceiveController extends Controller
{
    private $root = 'receive/lpo/';
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
        return view($this->root . 'index',$data);
    }

    public function lpoReceiveDatatableData(Request $request){
        $store_id = $request->store_id;
        $data = LpoReceive::with(['purchase.vendor', 'purchase.purchase_items', 'purchase.location', 'user']);
        if ($store_id != 0) {
            $data = $data->where('purchase_id', $store_id);
        }
    
        $data = $data->get();

        //return $data;

        return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('location', function(LpoReceive $product){
                    return $product->purchase->location->name;
                })
                ->editColumn('received_by', function(LpoReceive $product){
                    return $product->user->name;
                })
                ->editColumn('total_items', function(LpoReceive $product){
                    return count($product->purchase->purchase_items);
                })
                ->editColumn('vendor', function(LpoReceive $product){
                    return $product->purchase->vendor->name;
                })
                ->editColumn('vendor_invoice', function(LpoReceive $product){
                    return $product->vendor_invoice_no;
                })
                ->editColumn('grand_total', function(LpoReceive $product){
                    return Helpers::purchaseGrandTotal($product->purchase_id);
                })
                ->editColumn('payment_date', function(LpoReceive $product){
                    return date('d/m/Y', strtotime($product->created_at)) .'+'. $product->purchase->vendor->payment_term;
                })

                ->editColumn('created_at', function(LpoReceive $product){
                    return date('d/m/Y', strtotime($product->created_at));
                })
                ->editColumn('action', function(LpoReceive $product){
                    return '<a href="/item/price_update/'.$product->id.'/edit"><i class="far fa-edit"></i></a>
                        <a href="#" data-toggle="modal" onclick="deleteData('.$product->id.')"><i class="far fa-trash-alt"></i></a>';
                })
                 ->rawColumns(['status', 'action'])
                ->make();
    }


    public function markAsPaid(Request $request){
        $ids = $request->selected;

        foreach ($ids as $key => $id) {
           $lpo =  UnPaidGrn::find($id);
           $lpo->is_paid = 1;
           $lpo->save();

           $paidgrn = new PaidGrn;
           $paidgrn->date = date('Y-m-d H:i:s');
           $paidgrn->un_paid_grn_id = $lpo->id;
           $paidgrn->purchase_id = $lpo->purchase_id;
           $paidgrn->location_id = $lpo->location_id;
           $paidgrn->reference = $lpo->reference;
           $paidgrn->vendor_id = $lpo->vendor_id;
           $paidgrn->user_id = $lpo->user_id;
           $paidgrn->vendor_invoice = $lpo->vendor_invoice;
           $paidgrn->total_due = $lpo->total_due;
           $paidgrn->payment_date = $lpo->payment_date;
           $paidgrn->is_paid = $lpo->is_paid;
           $paidgrn->save();

           $vendorTrans = new VendorTransaction;
            $vendorTrans->date = date('Y-m-d H:i:s');
            $vendorTrans->reference = $lpo->reference;
            $vendorTrans->location_id = $lpo->location_id;
            $vendorTrans->status = 0;
            $vendorTrans->document_file = '';
            $vendorTrans->vendor_id = $lpo->vendor_id;
            $vendorTrans->note = '';
            $vendorTrans->debit = $lpo->total_due;
            $vendorTrans->user_id = $lpo->user_id;
            $vendorTrans->un_paid_grn_id = $lpo->id;
            $vendorTrans->save();
        }
        
    }

    public function markAsUnPaid(Request $request){
        $ids = $request->selected;
        foreach ($ids as $key => $id) {
           $paid =  PaidGrn::find($id);
           $lpo =  UnPaidGrn::find($paid->un_paid_grn_id);
           $vendorTransDelete =  VendorTransaction::where('un_paid_grn_id', $lpo->id)->first();
           $lpo->is_paid = 0;
           $lpo->save();
           $vendorTransDelete->delete();
           $paid->delete();
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $reference_no = $request->reference_no;
        $vendor_invoice_no = $request->vendor_invoice_no;

        $purchase = Purchase::where('reference', $reference_no)->with(['vendor', 'purchase_items'])->first();
        if(!$purchase){
            return redirect()->back();
        }

        $checkLpo = LpoReceive::where('purchase_id', $purchase->id)->first();

        if($checkLpo){
            return redirect()->back()->with('warningss', 'This reference id already received!');
        }

        $dates = [
            'current_date' => date('Y/m/d'),
            'payment_date' => date('Y/m/d')

        ];

        $data = [
            'reference_no' => $reference_no,
            'vendor_invoice_no' => $vendor_invoice_no,
            'purchase' => $purchase,
            'dates' => $dates
        ];
        return view($this->root . 'create', $data);
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
            'reference_no' => 'required',
            'received_items' => 'required'
        ]);

        $purchase = \App\Purchase::where('reference', $request->reference_no)->first();

        $grandTotla =  $this->grandTotalforDue($purchase->id);

        $receive = new \App\LpoReceive();
        $receive->purchase_id = $purchase->id;
        $receive->shelf_life = $request->shelf_life;
        $receive->exipre_date = $request->exipre_date;
        $receive->reference_no = $request->reference;
        $receive->vendor_invoice_no = $request->vendor_invoice_no;
        $receive->user_id = Auth::id();

        if($receive->save()){

            // start UnPaidGrn and vendor transaction save to db
            $uppaidgrn = new UnPaidGrn;
            $uppaidgrn->date = date('Y-m-d H:i:s');
            $uppaidgrn->reference = $request->reference;
            $uppaidgrn->location_id = $purchase->location_id;
            $uppaidgrn->vendor_id = $purchase->vendor_id;
            $uppaidgrn->vendor_invoice = $request->vendor_invoice_no;
            $uppaidgrn->total_due = $grandTotla;
            $uppaidgrn->user_id = Auth::id();
            $uppaidgrn->save();
            // end UnPaidGrn and vendor transaction save to db

            $received_items = $request->received_items;
            $data = array(); //code by mostofa
            $vendor_data = array(); //code by mostofa
            foreach($received_items as $item){
                $lpo_item = new \App\LpoReceiveItem();
                $lpo_item->lpo_receive_id = $receive->id;
                $lpo_item->item_id = $item['id'];
                $lpo_item->cost = $item['cost'];
                $lpo_item->quantity = $item['quantity'];
                $lpo_item->discount = $item['discount'];
                $lpo_item->save();
                //coded by mostofa
                //item_id, location_id,op_type=1,quantity,end_point=3
                $push_data = [$lpo_item->item_id,$purchase->location_id,1,$lpo_item->quantity,3];
                $push_vendor_data=[$lpo_item->item_id,$purchase->vendor_id,1,$lpo_item->quantity,3];
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


    private function grandTotalforDue($purchase_id){
    $purchaseItems = PurchaseOrderWiseItem::with(['item', 'item.prices'])->where('purchase_id', $purchase_id)->get();
    $total = 0;
    $tax = 0;
    $tax_data = Tax::first();
    if($tax_data != null){
      $tax = $tax_data->amount;
    }
    foreach ($purchaseItems as $item) {
      $sub = 0;
        $sub = ($item->cost * $item->quantity);
        $sub = $sub - ($sub * $item->discount)/100;
        $sub = $sub + ($sub * $tax)/100;
        $total += $sub;
    }
    return number_format($total, 2);
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


    public function checkItemsExistance(Request $request){
        $purchase_id = $request->purchase_id;
        $item_id = $request->item_id;

        $check = PurchaseOrderWiseItem::where('purchase_id', $purchase_id)->where('item_id', $item_id)->get();

        if(count($check) <= 0){
            $status = 0;
        }else{
            $status = 1;
        }

        return $status;
    }

    public function productReceiveForSelectBox(Request $request){
        $search = $request->search;
        $purchase_id = $request->purchase_id;

        $products = PurchaseOrderWiseItem::with('productsBarcode')
                    ->where(static function ($query) use ($search) {
                        $query->where('barcode', 'like', '%'.$search.'%')
                                ->orWhereHas('productsBarcode', function($q) use ($search) {
                                    $q->where('name', 'like', '%'.$search.'%');
                                })
                                ->orWhereHas('productsBarcode', function($q) use ($search) {
                                    $q->where('name', 'like', '%'.$search.'%');
                                });
                        })
                    ->where('purchase_id', $purchase_id)
                    ->get();

            $data =[];

            foreach ($products as $key => $product) {
                $single = [];
               $single = [
                'label'=> $product->productsBarcode->code .' - '.$product->productsBarcode->name. ' - ' .$product->barcode,
                'code'=> $product->barcode
               ];

               array_push($data, $single);
            }

            $final = [
                'results'=>$data,
                'status'=> 0,
            ];
        return response()->json($final);

    }

    public function itemInfoWithPurchase(Request $request){
        $purchase_id = $request->purchase_id;
        $item_id = $request->id;
        $info = PurchaseOrderWiseItem::with('productsBarcode')
                                    ->where('purchase_id', $purchase_id)
                                    ->where('barcode', $item_id)->first();
        return response()->json($info);
    }
}
