<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Helpers;

class HelperController extends Controller
{
    public function generateReference(Request $request){
    	$table_name = $request->table;
    	$ref_code = $request->refcode;
    $lastData = DB::table($table_name)->orderBy('id', 'DESC')->first();

    if(!empty($lastData)){
    if(!empty($lastData->reference_no)){
      $ref = $lastData->reference_no;
      $field = 'reference_no';
    }else{
          $ref = $lastData->reference;
          $field = 'reference';
    }

      $config = [
          'table' => $table_name,
          'length' => strlen($ref),
          'prefix' => $ref_code,
          'field' => $field
      ];

        $new_ref = Helpers::generate($config);

    }else{
      $new_ref = $ref_code . '0010001';
    }

    return response()->json(['reference'=> $new_ref]);
    }


    public function quantityCheck(Request $request){
      $product_id = $request->product_id;
      dd($product_id);
      $location_id = $request->location_id;
      $quantity = Helpers::currentStockLocationWise($product_id, $location_id);

      return response()->json(['quantity'=> $quantity]);
    }
    public function quantityCheckByBarcode(Request $request){
      $code = $request->product_id;
      $product = \App\Product::where('barcode', $code)->first();
      $location_id = $request->location_id;
      $product_id = $product->id;
      $quantity = Helpers::currentStockLocationWise($product_id, $location_id);

      return response()->json(['quantity'=> $quantity]);
    }
}
