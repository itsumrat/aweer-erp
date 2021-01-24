<?php

namespace App\Http\Controllers;

use App\LpoReceive;
use App\PaidGrn;
use App\PaymentAdvanced;
use App\PaymentVoucher;
use App\PurchaseReturn;
use App\UnPaidGrn;
use App\Vendor;
use App\VendorTransaction;
use DataTables;
use Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    private $root = 'accounts/';

    public function unpaidGrn(){
        $stores = DB::table('stores')->get();
        $data = [
            'stores'=>$stores 
        ];
        $unpaidgnrs = UnPaidGrn::where('is_paid', 0)->with(['purchase', 'purchase.location', 'user'])->get();
        return view($this->root . 'unpaid_grn', $data, compact('unpaidgnrs'));
    }

    public function unpadiGrnData(Request $request){
       $store_id = $request->store_id;
       $vendor_id = $request->vendor_id;
        $data = UnPaidGrn::where('is_paid', 0)->with(['purchase', 'purchase.location', 'user']);
        if ($store_id != 0) {
            $data = $data->where('location_id', $store_id);
        }

        if ($vendor_id != 0) {
           $data = $data->where('vendor_id', $vendor_id);
        }
    
        $data = $data->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('location', function(UnPaidGrn $product){
                    return $product->location->name;
                })
                ->editColumn('checkbox', function(UnPaidGrn $product){
                    return '<input class="sel" type="checkbox" name="count_history" value="'.$product->id.'" >';
                })
                ->editColumn('reference_no', function(UnPaidGrn $product){
                    return $product->reference;
                })
                ->editColumn('received_by', function(UnPaidGrn $product){
                    return $product->user->name;
                })
                ->editColumn('total_items', function(UnPaidGrn $product){
                    return 'N/A';
                    // return count($product->purchase->purchase_items);
                })
                ->editColumn('vendor', function(UnPaidGrn $product){
                    return $product->vendor->name;
                })
                ->editColumn('vendor_invoice', function(UnPaidGrn $product){
                    return $product->vendor_invoice;
                })
                ->editColumn('grand_total', function(UnPaidGrn $product){
                    return $product->total_due;
                })
                ->editColumn('payment_date', function(UnPaidGrn $product){
                    return date('d/m/Y', strtotime($product->created_at)) .'+'. $product->vendor->payment_term;
                })

                ->editColumn('received_by', function(UnPaidGrn $product){
                    return $product->user->name;
                })
                ->editColumn('action', function(UnPaidGrn $product){
                    return '<a href="/item/price_update/'.$product->id.'/edit"><i class="far fa-edit"></i></a>
                        <a href="#" data-toggle="modal" onclick="deleteData('.$product->id.')"><i class="far fa-trash-alt"></i></a>';
                })
                 ->rawColumns(['status', 'action', 'checkbox'])
                ->make();
    }

    public function padiGrnData(Request $request){
       $store_id = $request->store_id;
       $vendor_id = $request->vendor_id;
        $data = PaidGrn::where('is_paid', true)->with(['purchase', 'purchase.location', 'user']);
        if ($store_id != 0) {
            $data = $data->where('location_id', $store_id);
        }

        if ($vendor_id != 0) {
           $data = $data->where('vendor_id', $vendor_id);
        }
    
        $data = $data->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('location', function(PaidGrn $product){
                    return $product->location->name;
                })
                // if ($product->dstatus == 1) {
                //     $disable = true;
                // }else{
                //     $disable = false;
                // }
                ->editColumn('checkbox', function(PaidGrn $product){
                    return '<input class="sel" type="checkbox" name="count_history" value="'.$product->id.'" >';
                })
                ->editColumn('received_by', function(PaidGrn $product){
                    return $product->user->name;
                })
                ->editColumn('reference_no', function(PaidGrn $product){
                    return $product->reference;
                })
                ->editColumn('total_items', function(PaidGrn $product){
                    return 'N/A';
                })
                ->editColumn('vendor', function(PaidGrn $product){
                    return $product->vendor->name;
                })
                ->editColumn('vendor_invoice', function(PaidGrn $product){
                    return $product->vendor_invoice;
                })
                ->editColumn('grand_total', function(PaidGrn $product){
                    return $product->total_due;
                })
                ->editColumn('payment_date', function(PaidGrn $product){
                    return date('d/m/Y', strtotime($product->created_at)) .'+'. $product->vendor->payment_term;
                })

                ->editColumn('received_by', function(PaidGrn $product){
                    return $product->user->name;
                })
                ->editColumn('action', function(PaidGrn $product){
                    return '<a href="/item/price_update/'.$product->id.'/edit"><i class="far fa-edit"></i></a>
                        <a href="#" data-toggle="modal" onclick="deleteData('.$product->id.')"><i class="far fa-trash-alt"></i></a>';
                })
                 ->rawColumns(['status', 'action', 'checkbox'])
                ->make();   
    }


    public function paidGrn(){
        $stores = DB::table('stores')->get();
        $data = [
            'stores'=>$stores 
        ];
        $paidgnrs = PaidGrn::where('is_paid', 1)->with(['purchase', 'purchase.location', 'user'])->get();
        return view($this->root . 'paid_grn', $data, compact('paidgnrs'));
    }

    public function vendorTransaction(Request $request){
        $stores = DB::table('stores')->get();
        $data = [
            'stores'=>$stores 
        ];
        $purchases = VendorTransaction::with(['vendor', 'purchase_items', 'purchase_items.item', 'purchase_items.item.prices'])->get();
        return view($this->root . 'vendor_transaction', $data, compact('purchases'));

    }

    public function vendorTransactionView(Request $request){
        $store_id = $request->store_id;
        $vendor_id = $request->vendor_id;
       $purchase = VendorTransaction::with(['vendor', 'purchase_items', 'purchase_items.item', 'purchase_items.item.prices']);

       if ($store_id != 0) {
           $purchase = $purchase->where('location_id', $store_id);
       }

       if ($vendor_id != 0) {
           $purchase = $purchase->where('vendor_id', $vendor_id);
       }
       $purchase = $purchase->get();

       //return $purchase;

        return Datatables::of($purchase)
                ->addIndexColumn()
                ->editColumn('location', function(VendorTransaction $req){
                    return $req->locationStore->name;
                })
                ->editColumn('checkbox', function(VendorTransaction $req){
                    return '<input class="sel" type="checkbox" name="count_history" value="'.$req->id.'" >';
                }) 
                ->editColumn('vendor', function(VendorTransaction $req){
                    return $req->vendor->name;
                })

                ->editColumn('debit', function(VendorTransaction $req){
                    return $req->debit ? $req->debit : 'N/A';
                })

                ->editColumn('credit', function(VendorTransaction $req){
                    return $req->credit ? $req->credit : 'N/A';
                })

                ->editColumn('invoice', function(VendorTransaction $req){
                    return 'N/A';
                })
                ->rawColumns(['checkbox'])
                ->make();
    }

    public function vendorPaymentVoucher(Request $request){

        $purchaseReturn = VendorTransaction::whereIn('id', $request->selected)->get();

        $uniqueLoc = VendorTransaction::whereIn('id', $request->selected)->get()
                    ->keyBy('location_id')
                    ->unique();

        $vendor_code = count($purchaseReturn);

        $total_invoice = count($purchaseReturn);
        
        $total_location = count($uniqueLoc);

        $total_debit = 0;
        foreach($purchaseReturn as $i=>$totd){
            $total_debit += $totd->debit;
        }

        $total_credit = 0;
        foreach($purchaseReturn as $i=>$totc){
            $total_credit += $totc->credit;
        }

        $vendorCount = PaymentVoucher::count();
        $prefixCon = "PV";
        if($vendorCount<1){
            $vendorRef = $prefixCon."100000";
        }
        else{
            $vendorRef =PaymentVoucher::orderBy('id', 'desc')->first()->reference;
            $num= (int)preg_replace('/[^0-9]/', '', $vendorRef);
            $vendorRef=$prefixCon.($num+1);
        }
       $payment = new PaymentVoucher;
       $payment->pvch_date = date('Y-m-d H:i:s');
       $payment->reference = $vendorRef;
       $payment->vendor_code = $vendor_code;
       $payment->total_invoice = $total_invoice;
       $payment->total_location = $total_location;
       $payment->total_debit = $total_debit;
       $payment->total_credit = $total_credit;
       $payment->net_amount = '';
       $payment->payment_amount = '';
       $payment->check_no = 'PV'. rand(1000, 9999);
       $payment->save();

    }

    public function paymentVoucher(){
        $stores = DB::table('stores')->get();
        $data = [
            'stores'=>$stores 
        ];
        $payments = PaymentVoucher:: with('vendor')->latest()
        ->get()
        ->keyBy('vendor_code')
        ->unique();
        return view($this->root . 'payment_voucher', $data, compact('payments'));
    }

    public function paymentVoucherShow(Request $request){
        $store_id = $request->store_id;
        $vendor_id = $request->vendor_id;
       $payment = PaymentVoucher::orderBy('id', 'DESC')->get();

       if ($store_id != 0) {
            $payment = $payment->where('total_location', $store_id);
        }

        if ($vendor_id != 0) {
           $payment = $payment->where('vendor_code', $vendor_id);
        }

        return Datatables::of($payment)
                ->addIndexColumn()
                ->editColumn('date', function(PaymentVoucher $req){
                    return $req->pvch_date;
                })
                ->editColumn('reference', function(PaymentVoucher $req){
                    return $req->reference;
                })
                ->editColumn('vendor', function(PaymentVoucher $req){
                    return $req->vendor->code;
                })

                ->editColumn('total_invoice', function(PaymentVoucher $req){
                    return $req->total_invoice;
                })

                ->editColumn('total_location', function(PaymentVoucher $req){
                    return $req->total_location;
                })

                ->editColumn('total_debit', function(PaymentVoucher $req){
                    return $req->total_debit ? $req->total_debit : 'N/A';
                })

                ->editColumn('total_credit', function(PaymentVoucher $req){
                    return $req->total_credit ? $req->total_credit : 'N/A';
                })
                ->editColumn('other_debit', function(PaymentVoucher $req){
                    return $req->other_debit;
                })

                ->editColumn('other_credit', function(PaymentVoucher $req){
                    return $req->other_credit;
                })

                ->editColumn('net_amount', function(PaymentVoucher $req){
                    return ($req->total_debit + $req->other_debit) - ($req->total_credit + $req->other_credit + $req->adj_advance);
                })

                ->editColumn('payment_amount', function(PaymentVoucher $req){
                    return $req->payment_amount;
                })

                ->editColumn('adj_advance', function(PaymentVoucher $req){
                    return $req->adj_advance;
                })

                ->editColumn('ac_no', function(PaymentVoucher $req){
                    return $req->account_no;
                })
                
                ->editColumn('action', function(PaymentVoucher $req){
                    return '<div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle btn-action" type="button" id="itemActionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="itemActionDropdown">
                                <a class="dropdown-item" href="#">View</a>
                                <a class="dropdown-item ddebit_id" href="javascript:void(0)" id="ddebit_id" data-id="'. $req->id .'" onclick="otherDebitModal('.$req->id.')">Add Dr Note</a>
                                <a class="dropdown-item" href="javascript:void(0)" id="credit_id" data-id="'. $req->id .'" onclick="otherCreditModal('.$req->id.')">Add Cr Note</a>
                                <a class="dropdown-item" href="#" onclick="adjusmentModal('.$req->vendor->id.')">Adjust Advance</a>
                                <a class="dropdown-item" href="#" onclick="paymentMethod('.$req->id.')">Payment Method</a>
                                <a class="dropdown-item" href="#">Generate Summary</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#itemDelModal">Delete</a>
                            </div>
                        </div>';
                })
                ->rawColumns(['action'])
                ->make();
    }

    public function paymentSummary(){
        return view($this->root . 'payment_summary');
    }

    public function otherDebit(Request $request){
        $paymentVoucher = PaymentVoucher::find($request->id);
        $paymentVoucher->other_debit = $request->other_debit;
        $paymentVoucher->save();
        return back();

    }

    public function otherCredit(Request $request){
        $paymentVoucher = PaymentVoucher::find($request->id);
        $paymentVoucher->other_credit = $request->other_credit;
        $paymentVoucher->save();
        return back();

    }

    public function paymentMethod(Request $request){
        $paymentVoucher = PaymentVoucher::find($request->id);
        $paymentVoucher->payment_amount = $request->payment_amount;
        $paymentVoucher->account_no = $request->account_no;
        $paymentVoucher->check_no = $request->check_no;
        $paymentVoucher->save();
        return back();

    }

    public function vendorAdvancedAmount($id){
        $advanced = PaymentAdvanced::where('vendor_id', $id)->first();
        return response()->json($advanced);

    }

    public function advPayment(Request $request){
        $advanced = PaymentAdvanced::where('vendor_id', $request->vendor_id)->first();
        $vendor = PaymentVoucher::where('vendor_code', $request->vendor_id)->get();
        $advanced->amount = $advanced->amount - $request->ad_amount;
        $advanced->save();

        foreach ($vendor as $key => $value) {
            $ad = PaymentVoucher::find($value->id);
            $ad->adj_advance = $ad->adj_advance + $request->ad_amount;
            $ad->save();
        }

        return back();

    }
    

    public function paymentAdvanced(Request $request){
        $vendors = Vendor::all();
        $paymentAdvanceds = PaymentAdvanced::with('vendor')->get();
        return view($this->root . 'payment_advanced', compact('paymentAdvanceds', 'vendors'));

    }

    public function paymentAdvancedView(Request $request){
       $purchase = PaymentAdvanced::with(['vendor'])->get();

        return Datatables::of($purchase)
                ->addIndexColumn()
                ->editColumn('date', function(PaymentAdvanced $req){
                    return $req->date;
                })
                ->editColumn('vendor', function(PaymentAdvanced $req){
                    return $req->vendor->name;
                })

                ->editColumn('description', function(PaymentAdvanced $req){
                    return $req->description;
                })

                ->editColumn('amount', function(PaymentAdvanced $req){
                    return $req->amount;
                })

                ->editColumn('paid_by', function(PaymentAdvanced $req){
                    return 'N/A';
                })
                ->editColumn('action', function(PaymentAdvanced $req){
                    return '<div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle btn-action" type="button" id="itemActionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="itemActionDropdown">
                                                        <a class="dropdown-item" href="#">View</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                        
                                                    </div>
                                                </div>';
                })
                ->make();
    }

    public function paymentAdvancedStore(Request $request){
        PaymentAdvanced::create($request->all());
        return redirect()->route('payment_advanced');
    }
}
