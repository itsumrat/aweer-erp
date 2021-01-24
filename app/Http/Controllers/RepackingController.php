<?php

namespace App\Http\Controllers;

use App\ProductPricing;
use App\Repacking;
use Illuminate\Http\Request;

class RepackingController extends Controller
{
    private $root = "modules/inventory/items/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->root . 'repacking_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // $request->validate([
        //     'name' => 'required',
        //     'code' => 'required|unique:products',
        //     'barcode' => 'required|unique:products',
        //     'department_id' => 'required',
        //     'category_id' => 'required',
        //     'unit_id' => 'required',
        //     'alert_quantity' => 'required',
        //     'delivery_mode' => 'required',
        //     'evalucation' => 'required',
        //     'price' => 'required',

        // ],[
        //     'name.required' => 'This field is required',
        //     'code.required' => 'This field is required',
        //     'barcode.required' => 'This field is required',
        //     'department_id.required' => 'This field is required',
        //     'category_id.required' => 'This field is required',
        //     'unit_id.required' => 'This field is required',
        //     'alert_quantity.required' => 'This field is required',
        //     'evalucation.required' => 'This field is required',
        //     'price.required' => 'Select at least one item',

        // ]);


        $checkItem = ProductPricing::where('barcode', $request->barcode)->first();
        //dd($checkItem);
        $checkItem->final_cost = $request->final_cost;
        $checkItem->markup = $request->markup;
        $checkItem->final_price = $request->final_price;
        $checkItem->save();

        // $item = new Repacking();

        // $item->name = $request->name;
        // $item->code = $request->code;
        // $item->barcode = $request->barcode;
        // $item->department_id = $request->department_id;
        // $item->category_id = $request->category_id;
        // $item->unit_id = $request->unit_id;
        // $item->alert_quantity = $request->alert_quantity;
        // $item->delivery_mode = $request->delivery_mode;
        // $item->evalucation = $request->evalucation;
        // $item->generic_description = $request->generic_description;
        // $item->short_description = $request->short_description;
        // $item->long_description = $request->long_description;
        // $item->quantity = $request->quantity;
        // $item->unit_price = $request->unit_price;
        // $item->product_id = $request->product_id;
        // $item->additional_cost = $request->additional_cost;
        // $item->price = $request->price;
        // $item->user_id = \Auth::id();

        // $item->note = $request->note;
        if($checkItem->save()){
            return redirect()->back()->with('success', 'Update Successfully!');
        }else{
            return redirect()->back()->with('error', 'Someting wrong!');
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Repacking  $repacking
     * @return \Illuminate\Http\Response
     */
    public function show(Repacking $repacking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Repacking  $repacking
     * @return \Illuminate\Http\Response
     */
    public function edit(Repacking $repacking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Repacking  $repacking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repacking $repacking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Repacking  $repacking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repacking $repacking)
    {
        //
    }
}
