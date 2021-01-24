<?php

namespace App\Http\Controllers;

use App\SubLedger;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class SubLedgerController extends Controller
{
    private $root = "finance/subledger/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subledger = SubLedger::all();
        $data = [
            'subledgers'=> $subledger,
        ];
        return view($this->root. 'index', $data);
    }


    public function subLedgerList(){
        $sled = SubLedger::all();

        return Datatables::of($sled)
            ->addColumn('sl', function($sled){
                return $sled->id;
            })
            ->addColumn('action', function($sled){
                return '<a href="#" data-toggle="modal" onclick="edit('.$sled->id.')"><i class="far fa-edit"></i></a>
                    <a href="#" data-toggle="modal" onclick="deleteData('.$sled->id.')"><i class="far fa-trash-alt"></i></a>';
            })
            ->make();
    }


    public function allSubLedgerData(){
        $sled = SubLedger::all();
        return response()->json($sled);
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
                'ledger_id' => 'required',
                'posting_type' => 'required',
                'subledger_code' => 'required',
                'subledger_head' => 'required',
                'op_balance' => 'required',
    
            ]
        );
      }else{
          $validator = Validator::make($request->all(), 
            [
                'ledger_id' => 'required',
                'posting_type' => 'required',
                'subledger_code' => 'required',
                'subledger_head' => 'required',
                'op_balance' => 'required',
    
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
        $ledgerId = $request->ledger_id;
        $postingType = $request->posting_type;
        $subledgerHead = $request->subledger_code;
        $subledgerCode = $request->subledger_head;
        $opBalance = $request->op_balance;
        $tracker = $request->tracker;

        if($tracker == 0 && $id==''){
            $sled = new SubLedger();
            $sled->ledger_id = $ledgerId;
            $sled->posting_type = $postingType;
            $sled->subledger_code = $subledgerHead;
            $sled->subledger_head = $subledgerCode;
            $sled->op_balance = $opBalance;

            if($sled->save()){
                $data = [
                    'status'=>201,
                    'msg' => 'Success',
                    'process'=>'add'
                ];
            }

        }else{
            $sled = SubLedger::find($id);
            $sled->ledger_id = $ledgerId;
            $sled->posting_type = $postingType;
            $sled->subledger_code = $subledgerHead;
            $sled->subledger_head = $subledgerCode;
            $sled->op_balance = $opBalance;

            if($sled->save()){
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
     * @param  \App\SubLedger  $subledger
     * @return \Illuminate\Http\Response
     */
    public function show(SubLedger $subledger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubLedger  $subledger
     * @return \Illuminate\Http\Response
     */
    public function edit(SubLedger $subledger)
    {
        //
    }

    public function subLedgerDetail(Request $request){
        $id = $request->id;
        $sled = SubLedger::find($id);
        return response()->json($sled);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubLedger  $subledger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubLedger $subledger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubLedger  $subledger
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubLedger $subledger)
    {
        //
    }
    public function deleteData(Request $request){
        $id = $request->id;

        $sled = SubLedger::find($id);
        if($sled->delete()){
            $data = [
                'msg' => 'Data Deleted successfully',
                'code'=> 200,
            ];

            return response()->json($data);
        }
    }
}
