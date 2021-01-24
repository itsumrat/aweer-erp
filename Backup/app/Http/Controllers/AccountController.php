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
                // ->editColumn('credit', function(VendorTransaction $req){
                //     $items = $req->purchase_items;
                //     $total = 0;
                //     if(!empty($items)){
                //         foreach ($items as $key => $item) {
                //             $single_item_total =  ($item->quantity * $item->item->prices->final_cost);
                //             $single_item_total = $single_item_total - ($single_item_total * $item->discount)/100;
                //             $total += $single_item_total;
                //         }
                //     }

                //     $total = $total - ($total * $req->discount)/100;
                //     $total = $total + ($total * $req->tax)/100;

                //     return $total;
                // })
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

        foreach ($purchaseReturn as $key => $purchase) {

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
           $payment->vendor_code = $purchase->vendor_id;
           $payment->total_invoice = '';
           $payment->total_location = $purchase->location_id;
           $payment->total_debit = $purchase->debit;
           $payment->total_credit = $purchase->credit;
           $payment->net_amount = '';
           $payment->payment_amount = '';
           $payment->check_no = 'PV'. rand(1000, 9999);
           $payment->save();
        }

    }

    public function paymentVoucher(){
        return view($this->root . 'payment_voucher');
    }

    public function paymentVoucherShow(Request $request){
       $payment = PaymentVoucher::orderBy('id', 'DESC')->get();

        return Datatables::of($payment)
                ->addIndexColumn()
                ->editColumn('date', function(PaymentVoucher $req){
                    return $req->pvch_date;
                })
                ->editColumn('reference', function(PaymentVoucher $req){
                    return $req->reference;
                })
                ->editColumn('vendor', function(PaymentVoucher $req){
                    return $req->vendor_code;
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
                    return 'N/A';
                })

                ->editColumn('other_credit', function(PaymentVoucher $req){
                    return 'N/A';
                })

                ->editColumn('net_amount', function(PaymentVoucher $req){
                    return $req->net_amount;
                })

                ->editColumn('payment_amount', function(PaymentVoucher $req){
                    return $req->payment_amount;
                })

                ->editColumn('adj_advance', function(PaymentVoucher $req){
                    return $req->adj_advance;
                })

                ->editColumn('ac_no', function(PaymentVoucher $req){
                    return 'N/A';
                })

                
                ->editColumn('action', function(PaymentVoucher $req){
                    return '<div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle btn-action" type="button" id="itemActionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="itemActionDropdown">
                                                        <a class="dropdown-item" href="#">View</a>
                                                        <a class="dropdown-item" href="#">Add Dr Note</a>
                                                        <a class="dropdown-item" href="#">Add Cr Note</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#adjusmentModal">Adjust Advance</a>
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
