<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransferReturn;
use App\TransferReturnItems;
use Illuminate\Support\Facades\DB;
use DataTables;

class TransferReturnController extends Controller
{
    private $root = 'return/transfer/';
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

    public function transferReturnData(Request $request){
        $store_id = $request->store_id;
        $users = TransferReturn::with(['transfer_from_location', 'transfer_to_location', 'transfer_return_items','transfer_return_items.item', 'transfer_return_items.item.prices', 'user']);
       // dd($users);
               
       if ($store_id != 0) {
        $users = $users->where('transfer_to', $store_id);
       }

    $users = $users->get();

        return Datatables::of($users)
                ->addIndexColumn()
                ->editColumn('transfer_from', function(TransferReturn $req){
                    return $req->transfer_from_location->name;
                })
                ->editColumn('transfer_to', function(TransferReturn $req){
                     return $req->transfer_to_location->name;
                })
                ->editColumn('total_items', function(TransferReturn $req){
                    return count($req->transfer_return_items);
                })
                ->editColumn('total_quantity', function(TransferReturn $req){
                    $items = $req->transfer_return_items;
                    $total_quantity = 0;
                    if(!empty($items)){
                        foreach ($items as $key => $item) {
                           $total_quantity += $item->quantity;
                        }
                    }

                    return $total_quantity;
                })
                ->editColumn('toal_cost', function(TransferReturn $req){
                    $items = $req->transfer_return_items;
                    $total_cost = 0;
                    if(!empty($items)){
                        foreach ($items as $key => $item) {
                           $total_cost += $item->quantity * $item->item->prices->final_cost;
                        }
                    }

                    return number_format($total_cost, 2);
                })
                ->editColumn('status', function(TransferReturn $req){
                    if($req->status == 1){
                        return 'Sent';
                    }
                    if($req->status == 2){
                        return 'Received';
                    }
                })
                ->editColumn('created_by', function(TransferReturn $req){
                   return $req->user->name;
                })
                ->editColumn('action', function(TransferReturn $req){
                    return '<div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle btn-action" type="button" id="itemActionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="itemActionDropdown">
                                                        <a class="dropdown-item" href="/transfer_return/'.$req->id.'">View</a>
                                                        <a class="dropdown-item" href="/transfer_return/'.$req->id.'/edit">Edit</a>
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
        // dd($request);
        $request->validate([
            'date' => 'required',
            'reference' => 'required',
            'status' => 'required',
            'transfer_from'=>'required',
            'transfer_to' => 'required',
        ]);


        if($request->transfer_from == $request->transfer_to){
            return redirect()->back()->with('error', 'Transfer Return can not possible between same location!');
        }

        $req = new TransferReturn();
        $file_name = '';

        if($request->file('document') != null){
        $fileName = time().'.'.$request->document->extension();  
   
        $request->document->move(public_path('uploads/transfer_return_document'), $fileName);
        $file_name = 'uploads/transfer_return_document/'.$fileName;
        }

        $req->date = $request->date;
        $req->reference = $request->reference;
        $req->status = $request->status;
        $req->transfer_from = $request->transfer_from;
        $req->transfer_to = $request->transfer_to;
        $req->note = $request->note;
        $req->document_file = $file_name;
        $req->user_id = \Auth::id();
        
        
        if($req->save()){
            $items = $request->transfer_items;
            foreach ($items as $item) {
                $req_item = new TransferReturnItems();
                $req_item->transfer_id = $req->id;
                $req_item->item_id = $item['id'];
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
        $transfer_return = TransferReturn::where('id', $id)->first();
        $data = [

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
