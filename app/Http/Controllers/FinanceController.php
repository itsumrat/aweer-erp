<?php

namespace App\Http\Controllers;

use DataTables;
use Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FinanceController extends Controller
{
    private $root = 'finance/';

    public function cashFlow(){
        return view($this->root . 'cash_flow');
    }

    public function cashFlowData(Request $request){
       $store_id = $request->store_id;
        $data = LpoReceive::where('is_paid', false)->with(['purchase', 'lop_receive_items', 'purchase.location', 'user']);
        if ($store_id != 0) {
            $data = $data->where('purchase_id', $store_id);
        }
    
        $data = $data->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('location', function(LpoReceive $product){
                    return $product->purchase->location->name;
                })
                ->editColumn('checkbox', function(LpoReceive $product){
                    return '<input class="sel" type="checkbox" name="count_history" value="'.$product->id.'" >';
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
                    return 'N/A';
                })

                ->editColumn('received_by', function(LpoReceive $product){
                    return $product->user->name;
                })
                ->editColumn('action', function(LpoReceive $product){
                    return '<a href="/item/price_update/'.$product->id.'/edit"><i class="far fa-edit"></i></a>
                        <a href="#" data-toggle="modal" onclick="deleteData('.$product->id.')"><i class="far fa-trash-alt"></i></a>';
                })
                 ->rawColumns(['status', 'action', 'checkbox'])
                ->make();
    }
    
    public function bankFlow(){
        return view($this->root . 'bank_flow');
    }

    public function bankFlowData(Request $request){
       $store_id = $request->store_id;
        $data = LpoReceive::where('is_paid', false)->with(['purchase', 'lop_receive_items', 'purchase.location', 'user']);
        if ($store_id != 0) {
            $data = $data->where('purchase_id', $store_id);
        }
    
        $data = $data->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('location', function(LpoReceive $product){
                    return $product->purchase->location->name;
                })
                ->editColumn('checkbox', function(LpoReceive $product){
                    return '<input class="sel" type="checkbox" name="count_history" value="'.$product->id.'" >';
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
                    return 'N/A';
                })

                ->editColumn('received_by', function(LpoReceive $product){
                    return $product->user->name;
                })
                ->editColumn('action', function(LpoReceive $product){
                    return '<a href="/item/price_update/'.$product->id.'/edit"><i class="far fa-edit"></i></a>
                        <a href="#" data-toggle="modal" onclick="deleteData('.$product->id.')"><i class="far fa-trash-alt"></i></a>';
                })
                 ->rawColumns(['status', 'action', 'checkbox'])
                ->make();
    }
    
    public function balanceSheet(){
        return view($this->root . 'balance_sheet');
    }

    public function balanceSheetData(Request $request){
       $store_id = $request->store_id;
        $data = LpoReceive::where('is_paid', false)->with(['purchase', 'lop_receive_items', 'purchase.location', 'user']);
        if ($store_id != 0) {
            $data = $data->where('purchase_id', $store_id);
        }
    
        $data = $data->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('location', function(LpoReceive $product){
                    return $product->purchase->location->name;
                })
                ->editColumn('checkbox', function(LpoReceive $product){
                    return '<input class="sel" type="checkbox" name="count_history" value="'.$product->id.'" >';
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
                    return 'N/A';
                })

                ->editColumn('received_by', function(LpoReceive $product){
                    return $product->user->name;
                })
                ->editColumn('action', function(LpoReceive $product){
                    return '<a href="/item/price_update/'.$product->id.'/edit"><i class="far fa-edit"></i></a>
                        <a href="#" data-toggle="modal" onclick="deleteData('.$product->id.')"><i class="far fa-trash-alt"></i></a>';
                })
                 ->rawColumns(['status', 'action', 'checkbox'])
                ->make();
    }
    
    public function trialBalance(){
        return view($this->root . 'trial_balance');
    }

    public function trialBalanceData(Request $request){
       $store_id = $request->store_id;
        $data = LpoReceive::where('is_paid', false)->with(['purchase', 'lop_receive_items', 'purchase.location', 'user']);
        if ($store_id != 0) {
            $data = $data->where('purchase_id', $store_id);
        }
    
        $data = $data->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('location', function(LpoReceive $product){
                    return $product->purchase->location->name;
                })
                ->editColumn('checkbox', function(LpoReceive $product){
                    return '<input class="sel" type="checkbox" name="count_history" value="'.$product->id.'" >';
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
                    return 'N/A';
                })

                ->editColumn('received_by', function(LpoReceive $product){
                    return $product->user->name;
                })
                ->editColumn('action', function(LpoReceive $product){
                    return '<a href="/item/price_update/'.$product->id.'/edit"><i class="far fa-edit"></i></a>
                        <a href="#" data-toggle="modal" onclick="deleteData('.$product->id.')"><i class="far fa-trash-alt"></i></a>';
                })
                 ->rawColumns(['status', 'action', 'checkbox'])
                ->make();
    }
    
    public function pnlReport(){
        return view($this->root . 'pnl_report');
    }

    public function pnlReportData(Request $request){
       $store_id = $request->store_id;
        $data = LpoReceive::where('is_paid', false)->with(['purchase', 'lop_receive_items', 'purchase.location', 'user']);
        if ($store_id != 0) {
            $data = $data->where('purchase_id', $store_id);
        }
    
        $data = $data->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('location', function(LpoReceive $product){
                    return $product->purchase->location->name;
                })
                ->editColumn('checkbox', function(LpoReceive $product){
                    return '<input class="sel" type="checkbox" name="count_history" value="'.$product->id.'" >';
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
                    return 'N/A';
                })

                ->editColumn('received_by', function(LpoReceive $product){
                    return $product->user->name;
                })
                ->editColumn('action', function(LpoReceive $product){
                    return '<a href="/item/price_update/'.$product->id.'/edit"><i class="far fa-edit"></i></a>
                        <a href="#" data-toggle="modal" onclick="deleteData('.$product->id.')"><i class="far fa-trash-alt"></i></a>';
                })
                 ->rawColumns(['status', 'action', 'checkbox'])
                ->make();
    }
    
    
    
    public function vatReturnIndex(){
        return view($this->root . 'vat_return');
    }

    public function vatReturnDatatableData(){
        $users = Product::with(['prices'])->get();

        return Datatables::of($users)
                ->addIndexColumn()
                ->editColumn('department', function(Product $product){
                    return $product->department->name;
                })
                ->editColumn('category', function(Product $product){
                    return $product->category->name;
                })
                ->editColumn('final_cost', function(Product $product){
                    return $product->prices->final_cost;
                })
                ->editColumn('markup', function(Product $product){
                    return $product->prices->markup;
                })
                ->editColumn('final_price', function(Product $product){
                    return $product->prices->final_price;
                })
                ->editColumn('unit', function(Product $product){
                    return $product->unit->name;
                })
                ->editColumn('opening_stock', function(Product $product){
                    return $product->quantity;
                })
                ->editColumn('adjustment', function(Product $product){
                    return 'test_data';
                })
                ->editColumn('damage', function(Product $product){
                    return 'test_data';
                })
                ->editColumn('purchase', function(Product $product){
                    return 'test_data';
                })
                ->editColumn('sold', function(Product $product){
                    return 'test_data';
                })
                ->editColumn('transfer', function(Product $product){
                    return 'test_data';
                })
                ->editColumn('current_stock', function(Product $product){
                    return 'test_data';
                })
                ->editColumn('svc', function(Product $product){
                    return 'test_data';
                })
                ->editColumn('svp', function(Product $product){
                    return 'test_data';
                })
                ->editColumn('action', function(Product $product){
                    return '<a href="items/'.$product->id.'/edit"><i class="far fa-edit"></i></a>
                        <a href="#" data-toggle="modal" onclick="deleteData('.$product->id.')"><i class="far fa-trash-alt"></i></a>';
                })
                ->make();
    }
    
    
}
