<?php

namespace App\Http\Controllers;

use App\Damage;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DamageController extends Controller
{
    private $root = "modules/inventory/damage/";
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
        return view($this->root. 'index',$data);
    }

    public function damageListDatatableData(Request $request){
       $store_id = $request->store_id;
       $users = Damage::with(['product', 'store']);
        if ($store_id != 0) {
            $users = $users->where('location', $store_id);
        }
 
        $users = $users->get();
        

        return Datatables::of($users)
                ->addIndexColumn()
                ->editColumn('sl', function(Damage $adjustment){
                    return $adjustment;
                })
                ->editColumn('product_name', function(Damage $adjustment){
                    return $adjustment->product->name;
                })
                ->editColumn('location', function(Damage $adjustment){
                    return $adjustment->store->name;
                })
                ->editColumn('created_by', function(Damage $adjustment){
                    return '';
                })
                ->editColumn('action', function(Damage $adjustment){
                    return '<a href="damage/'.$adjustment->id.'/edit"><i class="far fa-edit"></i></a>
                        <a href="#" data-toggle="modal" onclick="deleteData('.$adjustment->id.')"><i class="far fa-trash-alt"></i></a>';
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
        return view($this->root. 'create');
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
            'reference' => 'required|unique:adjustments',
            'location'=>'required',
            'product_id' => 'required',
            'unit_id'=>'required',
            'quantity'=> 'required'
        ]);
        $adjust = new Damage();
        $doc = '';
        if($request->doc_file){
        $doc = $request->doc_file->storeAs('damages', $request->doc_file->getClientOriginalName());
        }
        $adjust->date = $request->date;
        $adjust->reference = $request->reference;
        $adjust->doc_file = $doc;
        $adjust->item_id = $request->product_id;
        $adjust->unit_id = $request->unit_id;
        $adjust->quantity = $request->quantity;
        $adjust->location = $request->location;
        $adjust->note = $request->note;

        if($adjust->save()){
            $data=[
                //item_id, location_id,op_type=2,quantity,end_point=5
                [$adjust->item_id,$adjust->location,2,$adjust->quantity,5]
            ];
            \Helpers::callStockInOut($data);

            return redirect()->back()->with('success', 'Added Successfully!');
        }else{
            return redirect()->back()->with('error', 'Something wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Damage  $damage
     * @return \Illuminate\Http\Response
     */
    public function show(Damage $damage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Damage  $damage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adjustment = Damage::with(['store', 'product'])->where('id', $id)->first();
        return view($this->root.'edit', ['adjustment'=>$adjustment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Damage  $damage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Damage $damage)
    {
        $request->validate([
            'date' => 'required',
            'reference' => 'required',
            'location'=>'required',
            'product_id' => 'required',
            'unit_id'=>'required',
            'quantity'=> 'required'
        ]);
        if(!empty($request->doc_file)){
            $doc = $request->doc_file->storeAs('damages', $request->doc_file->getClientOriginalName());
          $damage->doc_file = $doc;

        }

        $damage->date = $request->date;
        $damage->reference = $request->reference;

        $damage->item_id = $request->product_id;
        $damage->unit_id = $request->unit_id;
        $damage->quantity = $request->quantity;
        $damage->location = $request->location;
        $damage->note = $request->note;

        if($damage->save()){
            return redirect()->back()->with('success', 'Updated Successfully!');
        }else{
            return redirect()->back()->with('error', 'Something wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Damage  $damage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Damage $damage)
    {
        //
    }
    public function damageDelete(Request $request){
        $product = Damage::find($request->id);
        if($product->delete()){
            return response()->json(['data'=>['msg'=>'delete success']]);
        }
    }

}
