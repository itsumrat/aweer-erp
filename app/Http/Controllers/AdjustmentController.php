<?php

namespace App\Http\Controllers;

use App\Adjustment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AdjustmentController extends Controller
{
    private $root = "modules/inventory/adjustment/";
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


    public function adjustmentListDatatableData(Request $request){
       $store_id = $request->store_id;
       $users = Adjustment::with(['product', 'store']);
       if ($store_id != 0) {
        $users = $users->where('location', $store_id);
    }

    $users = $users->get();

        return Datatables::of($users)
                ->addIndexColumn()
                ->editColumn('sl', function(Adjustment $adjustment){
                    return $adjustment;
                })
                ->editColumn('product_name', function(Adjustment $adjustment){
                    return $adjustment->product->name;
                })
                ->editColumn('location', function(Adjustment $adjustment){
                    return $adjustment->store->name;
                })
                ->editColumn('created_by', function(Adjustment $adjustment){
                    return '';
                })
                ->editColumn('action', function(Adjustment $adjustment){
                    return '<a href="adjustment/'.$adjustment->id.'/edit"><i class="far fa-edit"></i></a>
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
        $adjust = new Adjustment();
        $doc = '';
        if($request->doc_file){
        $doc = $request->doc_file->storeAs('adjustments', $request->doc_file->getClientOriginalName());
        }
        $adjust->date = $request->date;
        $adjust->reference = $request->reference;
        $adjust->doc_file = $doc;
        $adjust->item_id = $request->product_id;
        $adjust->unit_id = $request->unit_id;
        $adjust->quantity = $request->quantity;
        $adjust->location = $request->location;
        $adjust->note = $request->note;
        $adjust->user_id = \Auth::id();



        if($adjust->save()){
            $data=[
                //item_id, location_id,op_type=1,quantity,end_point=2
                [$adjust->item_id,$adjust->location,1,$adjust->quantity,2]
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
     * @param  \App\Adjustment  $adjustment
     * @return \Illuminate\Http\Response
     */
    public function show(Adjustment $adjustment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Adjustment  $adjustment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adjustment = Adjustment::with(['store', 'product'])->where('id', $id)->first();
        return view($this->root.'edit', ['adjustment'=>$adjustment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Adjustment  $adjustment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adjustment $adjustment)
    {
        $adjust = $adjustment;
        $request->validate([
            'date' => 'required',
            'reference' => 'required',
            'location'=>'required',
            'product_id' => 'required',
            'unit_id'=>'required',
            'quantity'=> 'required'
        ]);
        if(!empty($request->doc_file)){
            $doc = $request->doc_file->storeAs('adjustments', $request->doc_file->getClientOriginalName());
          $adjust->doc_file = $doc;

        }

        $adjust->date = $request->date;
        $adjust->reference = $request->reference;

        $adjust->item_id = $request->product_id;
        $adjust->unit_id = $request->unit_id;
        $adjust->quantity = $request->quantity;
        $adjust->location = $request->location;
        $adjust->note = $request->note;

        if($adjust->save()){
            return redirect()->back()->with('success', 'Updated Successfully!');
        }else{
            return redirect()->back()->with('error', 'Something wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Adjustment  $adjustment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adjustment $adjustment)
    {
        //
    }
    public function adjustmentDelete(Request $request){
        $product = Adjustment::find($request->id);
        if($product->delete()){
            return response()->json(['data'=>['msg'=>'delete success']]);
        }
    }
}
