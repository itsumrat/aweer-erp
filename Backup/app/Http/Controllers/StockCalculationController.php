<?php

namespace App\Http\Controllers;

use App\StockCalculation;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Helpers;
class StockCalculationController extends Controller
{
    private $root = "modules/inventory/stock_calculation/";
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

    public function zoneCountListData(Request $request){
        $store_id = $request->store_id;
        $users = StockCalculation::with(['item', 'location'])->groupBy('item_id');
        if ($store_id != 0) {
            $users =  $users->where('store_id', $store_id);
        }
 
        $users =  $users->get();
        
        return Datatables::of($users)
                ->addIndexColumn()
                ->editColumn('checkbox', function(StockCalculation $data){
                    return '<input class="sel" type="checkbox" name="count_history" value="'.$data->id.'" >';
                })
                ->editColumn('location', function(StockCalculation $data){
                    return $data->location->name;
                })
                ->editColumn('item', function(StockCalculation $data){
                    return $data->item->name .' - '. $data->item->code;
                })
                ->editColumn('zone', function(StockCalculation $data){
                    return StockCalculation::where('item_id', $data->item_id)->take(5)->pluck('zone');
                })
                ->editColumn('stock', function(StockCalculation $data){
                    return Helpers::currentStockLocationWise($data->item_id, $data->store_id);
                })
                ->editColumn('counted_stocks', function(StockCalculation $data){
                    return StockCalculation::where('item_id', $data->item_id)->sum('counted_stock');
                })
                ->editColumn('variance', function(StockCalculation $data){
                    $counted_stock = StockCalculation::where('item_id', $data->item_id)->sum('counted_stock');
                    $stock = Helpers::currentStockLocationWise($data->item_id, $data->store_id);
                    return $counted_stock - $stock;
                })
                ->editColumn('status', function(StockCalculation $data){
                    if($data->status == 1){
                        return '<span class="label label-success"><i class="fa fa-check"></i> updated</span>';
                    }else{
                        return '<span class="label label-danger"><i class="fa fa-cross"></i> Pending</span>';
                    }

                })
                ->rawColumns(['status', 'checkbox'])
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
            'zone' => 'required',
            'store_id'=> 'required',
            'product_id'=> 'required',
            'counted_stock'=> 'required',
        ],[

            'zone.required' => 'This field is required',
            'store_id.required' => 'This field is required',
            'product_id.required' => 'This field is required',
            'counted_stock.required' => 'This field is required',
        ]);


        $stock = new StockCalculation();
        $action = $request->action;

        $stock->zone = $request->zone;
        $zone = $request->zone;
        $stock->store_id = $request->store_id;
        $stock->item_id = $request->product_id;
        $stock->counted_stock = $request->counted_stock;
        $stock->stock = Helpers::currentStockLocationWise($request->product_id, $request->store_id);
        $stock->user_id = \Auth::id();

        if($stock->save()){

            if($action == 'send'){
                $store_info = \App\Location::find($request->store_id);
                          
                return redirect()->back()->with(['success'=>'Added Successfully!', 'zone'=> $zone, 'location_id' => $store_info->id, 'location_name'=>$store_info->name]);
            }
            return redirect()->back()->with('success', 'Added Successfully!');
        }
        return redirect()->back()->with('error', 'Something wrong!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StockCalculation  $stockCalculation
     * @return \Illuminate\Http\Response
     */
    public function show(StockCalculation $stockCalculation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StockCalculation  $stockCalculation
     * @return \Illuminate\Http\Response
     */
    public function edit(StockCalculation $stockCalculation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StockCalculation  $stockCalculation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockCalculation $stockCalculation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StockCalculation  $stockCalculation
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockCalculation $stockCalculation)
    {
        //
    }


    public function makeDamange(Request $request){
        $selected = $request->selected;

        foreach ($selected as $key => $value) {
           $stock = StockCalculation::where('id', $value)->with(['item', 'location'])->first();
           $damage = new \App\Damage();

           $damage->date = Carbon::now();
           $damage->reference = $this->makeRef('damages', 'DMG');
           $damage->location = $stock->store_id;
           $damage->doc_file = '';
           $damage->unit_id = 0;
           $damage->item_id = $stock->item_id;
           $damage->quantity = $stock->stock - $stock->counted_stock;
           $damage->user_id = \Auth::id();

           if($damage->save()){
            $stock->status = 1;
            $stock->save();
            return response()->json(['status'=>200, 'msg'=> 'Damage Added']);
           }
        }
    }

    public function makeAdjustment(Request $request){
        $selected = $request->selected;

        foreach ($selected as $key => $value) {
           $stock = StockCalculation::where('id', $value)->with(['item', 'location'])->first();
           $damage = new \App\Adjustment();

           $damage->date = Carbon::now();
           $damage->reference = $this->makeRef('adjustments', 'ADJ');
           $damage->location = $stock->store_id;
           $damage->doc_file = '';
           $damage->unit_id = 0;
           $damage->item_id = $stock->item_id;
           $damage->quantity = $stock->counted_stock - $stock->stock;
           $damage->user_id = \Auth::id();

           if($damage->save()){
            $stock->status = 1;
            $stock->save();
            return response()->json(['status'=>200, 'msg'=> 'adjustments Added']);
           }
        }
    }

    public function makeRef($table_name, $ref_code){
    $lastData = DB::table($table_name)->orderBy('id', 'DESC')->first();

    if(!empty($lastData)){
      $ref = $lastData->reference;
      $substr = (int)substr($ref, -7);
      $substr++;
      $new_ref = $ref_code.$substr;
    }else{
      $new_ref = $ref_code . '0010001';
    }

    return $new_ref;
    }
}
