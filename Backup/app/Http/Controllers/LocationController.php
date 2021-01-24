<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class LocationController extends Controller
{
    public function locationDataForSelectBox(Request $request){
    	        $search = $request->search;
        $locations = Location::where('name', 'LIKE' , '%'.$search.'%')->orWhere('code', 'LIKE' , '%'.$search.'%')->limit(10)->orderBy('id', 'desc')->get();
        $data =[];

        foreach ($locations as $key => $product) {
            $single = [];
           $single = [
            'label'=> $product->name,
            'code'=> $product->id
           ];

           array_push($data, $single);
        }

        $final = [
            'results'=>$data
        ];
        return response()->json($final);
    }


    public function locationDataById(Request $request){
        $info = Location::find($request->id);

        return response()->json($info);
    }
}
