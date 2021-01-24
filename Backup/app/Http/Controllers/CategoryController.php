<?php

namespace App\Http\Controllers;

use App\Category;
use App\Department;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    private $root = "modules/inventory/settings/category/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        $department = Department::all();
        $data = [
            'categories'=> $category,
            'departments' => $department,
        ];
        return view($this->root. 'index', $data);
    }


    public function categoryList(){
        $cat = Category::all();

        return Datatables::of($cat)
            ->addColumn('sl', function($cat){
                return $cat->id;
            })
            ->addColumn('action', function($cat){
                return '<a href="#" data-toggle="modal" onclick="edit('.$cat->id.')"><i class="far fa-edit"></i></a>
                    <a href="#" data-toggle="modal" onclick="deleteData('.$cat->id.')"><i class="far fa-trash-alt"></i></a>';
            })
            ->editColumn('parent_category', function($cat){
                if($cat->parent_category == 0){
                    return "N/A";
                }
                else{
                   return Category::where('id',$cat->parent_category)->first()->name;
                }
            })
            ->make();
    }


    public function allCategoryData(){
        $cat = Category::all();
        return response()->json($cat);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if($request->tracker==0){
            $validator = Validator::make($request->all(), 
                    [
                        'name' => 'required',
                        'code' => 'required|unique:categories',

                    ]
                );
        }else{
            $validator = Validator::make($request->all(), 
                    [
                        'name' => 'required',
                        'code' => 'required',

                    ]
                );
        }


        if (!$validator->passes()) {
            $errorData = [
                'error'=>$validator->errors()->all(),
                'tracker'=>0,
                ];
            return response()->json($errorData);
        }



        $id = $request->id;
        $name = $request->name;
        $code = $request->code;
        $department_id = $request->department;
        $desc = $request->description;
        $parent_cat = isset($request->parent_cat)?$request->parent_cat:0;
        $tracker = $request->tracker;

        if($tracker == 0 && $id==''){
            $dept = new Category();
            $dept->name = $name;
            $dept->code = $code;
            $dept->department_id = $department_id;
            $dept->parent_category = $parent_cat;
            $dept->description = $desc;

            if($dept->save()){
                $data = [
                    'status'=>201,
                    'msg' => 'Success',
                    'process'=>'add'
                ];
            }

        }else{
            $dept =Category::find($id);
            $dept->name = $name;
            $dept->code = $code;
            $dept->department_id = $department_id;
            $dept->parent_category = $parent_cat;
            $dept->description = $desc;

            if($dept->save()){
                $data = [
                    'status'=>201,
                    'msg' => 'Success',
                    'process'=>'update'
                ];
            }
        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    public function categoryDetail(Request $request){
        $id = $request->id;
        $dept = Category::find($id);
        return response()->json($dept);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
    public function deleteData(Request $request){
        $id = $request->id;

        $cat = Category::find($id);
        if($cat->delete()){
            $childs = Category::where('parent_category', $id)->delete();
            $data = [
                'msg' => 'Data Deleted successfully',
                'code'=> 200,
            ];

            return response()->json($data);
        }
    }
}
