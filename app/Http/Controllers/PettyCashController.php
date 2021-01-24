<?php

namespace App\Http\Controllers;

use App\PettyCash;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class PettyCashController extends Controller
{
    private $root = 'finance/petty_cash/';

    /**
     * Show the form for creating a new resource.
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

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $pcash
     * @return \Illuminate\Http\Response
     */
     
    public function pettyCashData(Request $request){
       $store_id = $request->store_id;
       $pcash = PettyCash::with(['pcash_curr_balance', 'date', 'loc_code', 'exp_amount', 'particulars', 'exp_by', 'status']);


       if ($store_id != 0) {
           $pcash = $pcash->where('location_id', $store_id);
       }

       $pcash = $pcash->get();

        return Datatables::of($pcash)
                ->addIndexColumn()

                ->editColumn('status', function(PettyCash $req){
                    if($req->status == 0){
                        return 'Draft';
                    }
                    if($req->status == 1){
                        return 'Final';
                    }
                })
                ->editColumn('action', function(PettyCash $req){
                    return '<div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle btn-action" type="button" id="itemActionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="itemActionDropdown">
                                    <a class="dropdown-item" href="/petty_cash/'.$req->id.'">View</a>
                                    <a class="dropdown-item" href="/petty_cash/'.$req->id.'/edit">Edit</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#statusUpdateModal">Update Status</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#requisitionDelModal">Delete</a>
                                </div>
                            </div>';
                })
                ->make();
    }
    
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
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
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

}
