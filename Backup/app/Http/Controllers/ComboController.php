<?php

namespace App\Http\Controllers;

use App\Combo;
use Illuminate\Http\Request;
use Auth;
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
            'barcode' => 'required|unique:products',
            'unit_id' => 'required',
            'combo_price' => 'required|numeric',

        ],[
            'barcode.required' => 'This field is required',
            'unit_id.required' => 'This field is required',
            'combo_price.required' => 'This field is required'

        ]
    );

        $item = new Combo();

        $item->product_id = $request->product_id;
        $item->barcode = $request->barcode;
        $item->unit_id = $request->unit_id;
        $item->combo_price = $request->combo_price;
        $item->note = $request->note;
        $item->user_id = Auth::id();
        if($item->save()){
            return redirect()->back()->with('success', 'Added Successfully!');
            
        }

        return redirect()->back()->with('error', 'Something wrong!');

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
