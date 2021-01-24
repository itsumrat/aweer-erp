<?php

namespace App\Http\Controllers;

use App\Combo;
use App\ProductPricing;
use Auth;
use Illuminate\Http\Request;
class ComboController extends Controller
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
        return view($this->root . 'combo_create');
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
            'product_id' => 'required',
            'barcode' => 'required|unique:combos',
            'unit_id' => 'required',
            'vendor_id' => 'required',

        ],[
            'product_id.required' => 'This field is required',
            'barcode.required' => 'This field is required',
            'unit_id.required' => 'This field is required',
            'vendor_id.required' => 'This field is required'

        ]
    );
        //dd($request->all());

        $item = new Combo();

        $item->product_id = $request->product_id;
        $item->barcode = $request->barcode;
        $item->unit_id = $request->unit_id;
        $item->vendor_id = $request->vendor_id;
        $item->user_id = Auth::id();
        if($item->save()){
            $price = new ProductPricing;
            $price->product_id = $request->product_id;
            $price->barcode = $request->barcode;
            $price->vendor_id = $request->vendor_id;
            $price->markup = 0;
            $price->final_price = 0;
            $price->unit_id = $request->unit_id;

            $vendors = $request->vendors;
           
            if(!empty($vendors )){
                foreach ($vendors as $vendor) {
                    $vend = new \App\ProductWiseVendor();

                    $vend->vendor_id = $vendor['id'];
                    $vend->vendor_price = $vendor['price'];

                    $item->product_wise_vendor()->save($vend);
                }
            }

            //if($item->prices()->save($price)){
            if($price->save()){
                return redirect()->back()->with('success', 'Added Successfully!');
            }else{
                return redirect()->back()->with('error', 'Something wrong!');
            }
        }else{
                return redirect()->back()->with('error', 'Something wrong!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function show(Combo $combo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function edit(Combo $combo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Combo $combo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Combo $combo)
    {
        //
    }
}
