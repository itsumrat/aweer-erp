<?php

namespace App\Http\Controllers;

use App\Transfer;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use App\TransferItems;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    private $root = 'transfer/';
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

    public function transferOrderTableData(Request $request){
        $store_id = $request->store_id;
        $users = Transfer::with(['transfer_from_location', 'transfer_to_location', 'transfer_items','transfer_items.item', 'transfer_items.item.prices']);
       // dd($users);
               
       if ($store_id != 0) {
        $users = $users->where('transfer_to', $store_id);
       }

    $users = $users->get();

        return Datatables::of($users)
                ->addIndexColumn()
                ->editColumn('transfer_from', function(Transfer $req){
                    return $req->transfer_from_location->name;
                })
                ->editColumn('transfer_to', function(Transfer $req){
                     return $req->transfer_to_location->name;
                })
                ->editColumn('total_items', function(Transfer $req){
                    return count($req->transfer_items);
                })
                ->editColumn('total_quantity', function(Transfer $req){
                    $items = $req->transfer_items;
                    $total_quantity = 0;
                    if(!empty($items)){
                        foreach ($items as $key => $item) {
                           $total_quantity += $item->quantity;
                        }
                    }

                    return $total_quantity;
                })
                ->editColumn('toal_cost', function(Transfer $req){
                    $items = $req->transfer_items;
                    $total_cost = 0;
                    if(!empty($items)){
                        foreach ($items as $key => $item) {
                           $total_cost += $item->quantity * $item->item->prices->final_cost;
                        }
                    }

                    return number_format($total_cost, 2);
                })
                ->editColumn('status', function(Transfer $req){
                    if($req->status == 1){
                        return 'Sent';
                    }
                    if($req->status == 2){
                        return 'Received';
                    }
                })
                ->editColumn('action', function(Transfer $req){
                    return '<div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle btn-action" type="button" id="itemActionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="itemActionDropdown">
                                                        <a class="dropdown-item" href="/transfer/'.$req->id.'">View</a>
                                                        <a class="dropdown-item" href="/transfer/'.$req->id.'/edit">Edit</a>
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
            return redirect()->back()->with('error', 'Transfer can not possible between same location!');
        }
        $req = new Transfer();
        $file_name = '';

        if($request->file('document') != null){
        $fileName = time().'.'.$request->document->extension();  
   
        $request->document->move(public_path('uploads/transfer_document'), $fileName);
        $file_name = 'uploads/transfer_document/'.$fileName;
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
                $req_item = new TransferItems();
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
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show(Transfer $transfer)
    {
        return view($this->root . 'view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transfer = Transfer::with(['transfer_from_location', 'transfer_to_location', 'transfer_items','transfer_items.item', 'transfer_items.item.prices'])->where('id', $id)->first();
        $data = [
            'transfer' => $transfer
        ];
        return view($this->root . 'edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'reference' => 'required',
            'status' => 'required',
            'transfer_from'=>'required',
            'transfer_to' => 'required',
        ]);

        $req = Transfer::find($id);
        $file_name = '';

        if($request->file('document') != null){
        $fileName = time().'.'.$request->document->extension();  
   
        $request->document->move(public_path('uploads/transfer_document'), $fileName);
        $file_name = 'uploads/transfer_document/'.$fileName;
        }

        $req->date = $request->date;
        $req->reference = $request->reference;
        $req->status = $request->status;
        $req->transfer_from = $request->transfer_from;
        $req->transfer_to = $request->transfer_to;
        $req->note = $request->note;
        $req->document_file = $file_name;
        
        
        if($req->save()){
            $items = $request->transfer_items;
            TransferItems::where('transfer_id',$id)->delete();
            foreach ($items as $item) {
                $req_item = new TransferItems();
                $req_item->transfer_id = $id;
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
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        //
    }
    public function transferItemsById(Request $request){
        $id = $request->id;

        $transfer = Transfer::with(['transfer_from_location', 'transfer_to_location', 'transfer_items','transfer_items.item', 'transfer_items.item.prices'])->where('id', $id)->first();
        return response()->json($transfer);
    }
}
