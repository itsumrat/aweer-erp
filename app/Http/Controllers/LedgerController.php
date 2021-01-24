<?php

namespace App\Http\Controllers;

use App\Ledger;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class LedgerController extends Controller
{
    private $root = "finance/ledger/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ledger = Ledger::all();
        $data = [
            'ledgers'=> $ledger,
        ];
        return view($this->root. 'index', $data);
    }


    public function ledgerList(){
        $led = Ledger::all();

        return Datatables::of($led)
            ->addColumn('sl', function($led){
                return $led->id;
            })
            ->addColumn('action', function($led){
                return '<a href="#" data-toggle="modal" onclick="edit('.$led->id.')"><i class="far fa-edit"></i></a>
                    <a href="#" data-toggle="modal" onclick="deleteData('.$led->id.')"><i class="far fa-trash-alt"></i></a>';
            })
            ->make();
    }


    public function allLedgerData(){
        $led = Ledger::all();
        return response()->json($led);
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
        if($request->tracker == 0 && $request->id == ''){
        $validator = Validator::make($request->all(), 
            [
                'main_ac' => 'required',
                'ac_category' => 'required',
                'report_type' => 'required',
                'ledger_code' => 'required',
                'ledger_head' => 'required',
    
            ]
        );
      }else{
          $validator = Validator::make($request->all(), 
            [
                'main_ac' => 'required',
                'ac_category' => 'required',
                'report_type' => 'required',
                'ledger_code' => 'required',
                'ledger_head' => 'required',
    
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
        $mainAccount = $request->main_ac;
        $acCategory = $request->ac_category;
        $reportType = $request->report_type;
        $ledgerCode = $request->ledger_code;
        $ledgerHead = $request->ledger_head;
        $tracker = $request->tracker;

        if($tracker == 0 && $id==''){
            $led = new Ledger();
            $led->main_ac = $mainAccount;
            $led->ac_category = $acCategory;
            $led->report_type = $reportType;
            $led->ledger_code = $ledgerCode;
            $led->ledger_head = $ledgerHead;

            if($led->save()){
                $data = [
                    'status'=>201,
                    'msg' => 'Success',
                    'process'=>'add'
                ];
            }

        }else{
            $led =Ledger::find($id);
            $led->main_ac = $mainAccount;
            $led->ac_category = $acCategory;
            $led->report_type = $reportType;
            $led->ledger_code = $ledgerCode;
            $led->ledger_head = $ledgerHead;

            if($led->save()){
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
     * @param  \App\Ledger  $ledger
     * @return \Illuminate\Http\Response
     */
    public function show(Ledger $ledger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ledger  $ledger
     * @return \Illuminate\Http\Response
     */
    public function edit(Ledger $ledger)
    {
        //
    }

    public function ledgerDetail(Request $request){
        $id = $request->id;
        $led = Ledger::find($id);
        return response()->json($led);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ledger  $ledger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ledger $ledger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ledger  $ledger
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ledger $ledger)
    {
        //
    }
    public function deleteData(Request $request){
        $id = $request->id;

        $led = Ledger::find($id);
        if($led->delete()){
            $data = [
                'msg' => 'Data Deleted successfully',
                'code'=> 200,
            ];

            return response()->json($data);
        }
    }
}
