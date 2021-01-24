<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requisition;
use App\RequisitionWiseItem;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DSDRequisitionController extends Controller
{
    private $root = 'requisition/dsd/';
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

    public function dsdRequisitionTableData(Request $request){
        $store_id = $request->store_id;
       $users = Requisition::where('type', 3)->with(['requisition_items','requisition_items.item' ,'requisition_items.item.prices']);
       // dd($users);
       
       if ($store_id != 0) {
        $users = $users->where('requisition_to', $store_id);
    }

    $users = $users->get();

        return Datatables::of($users)
                ->addIndexColumn()
                ->editColumn('total_quantity', function(Requisition $req){
                    $items =  $req->requisition_items;
                    // return $items;

                    $total = 0;
                    foreach ($items as $item) {
                        $total += $item->quantity;
                    }
                    return $total;
                })
                ->editColumn('requisition_from', function(Requisition $req){
                    return $req->requisition_from_location->name;
                })

                ->editColumn('requisition_to', function(Requisition $req){
                    return $req->requisition_to_location->name;
                })

                ->editColumn('total_amount', function(Requisition $req){
                    $items =  $req->requisition_items;
                    $total = 0;
                    foreach ($items as $item) {
                        $item_quantity = $item->quantity;
                        $item_cost = $item->item->prices->final_cost;
                        $total += ($item_quantity * $item_cost);

                    }
                    
                    return $total;
                })
                ->editColumn('status', function(Requisition $req){
                    if($req->status == 0){
                        return 'Pending';
                    }
                    if($req->status == 1){
                        return 'Sent';
                    }
                })
                ->editColumn('action', function(Requisition $req){
                    return '                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle btn-action" type="button" id="itemActionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="itemActionDropdown">
                                                        <a class="dropdown-item" href="/requisition/show/'.$req->id.'">View</a>
                                                        <a class="dropdown-item" href="/dsd_requisition/'.$req->id.'/edit">Edit</a>
                                                        <a class="dropdown-item" href="#">Update Status</a>
                                                        <a class="dropdown-item" href="#">Make LPO</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#itemDelModal">Delete</a>
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
            'reference' => 'required',
            'status' => 'required',
            'requisition_from'=>'required',
            'requisition_to' => 'required',
        ]);

        $req = new Requisition();

        $req->date = $request->date;
        $req->reference = $request->reference;
        $req->status = $request->status;
        $req->requisition_from = $request->requisition_from;
        $req->requisition_to = $request->requisition_to;
        $req->note = $request->note;
        $req->status = $request->status;
        $req->type = '3';

        if($req->save()){
            $items = $request->requisition_items;
            foreach ($items as $item) {
                $req_item = new RequisitionWiseItem();
                $req_item->requisition_id = $req->id;
                $req_item->item_id = $item['id'];
                $req_item->barcode = $item['barcode'];
                $req_item->quantity = $item['quantity'];
                $req_item->save();
                
            }
            return redirect()->back()->with('success', 'Added Successfully!');
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
        $requisition = Requisition::with(['requisition_from_location', 'requisition_to_location', 'requisition_items', 'requisition_items.item'])->where('id', $id)->first();
        $data = [
            'requisition' => $requisition,
        ];
        return view($this->root . 'edit', $data);
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
         // dd($request);
        $request->validate([
            'date' => 'required',
            'reference' => 'required',
            'status' => 'required',
            'requisition_from'=>'required',
            'requisition_to' => 'required',
        ]);

        $req = Requisition::find($id);

        $req->date = $request->date;
        $req->reference = $request->reference;
        $req->status = $request->status;
        $req->requisition_from = $request->requisition_from;
        $req->requisition_to = $request->requisition_to;
        $req->note = $request->note;
        $req->status = $request->status;
        $req->type = '3';

        if($req->save()){
            $items = $request->requisition_items;
            RequisitionWiseItem::where('requisition_id', $id)->delete();
            foreach ($items as $item) {
                $req_item = new RequisitionWiseItem();
                $req_item->requisition_id = $id;
                $req_item->item_id = $item['id'];
                $req_item->quantity = $item['quantity'];
                $req_item->save();
                
            }
            return redirect()->back()->with('success', 'Updated Successfully!');
        }
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
