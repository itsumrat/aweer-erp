@extends('layouts/app')

@section('title', 'Dashboard - Hand Over Take Over')

@section('main_content')

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;width:100%;}
.tg input {border:0;text-align:center;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:12px;
  overflow:hidden;padding:0 20px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:20px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-0lax{text-align:left;vertical-align:top}
.text-center {text-align:center;}
.text-right {text-align:right;}
.xxl-bold {font-weight:bold;font-size:16px!important;}
.xl-bold {font-weight:bold;font-size:14px!important;}
.bold {font-weight:bold;font-size:13px!important;}
</style>

        <main class="page-content" id="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Audit / Hand Over Take Over</h5>
                            </div>
                            @if(session('success'))
                                <h1 class="text-success">{{session('success')}}</h1>
                            @endif
                            @if(session('error'))
                                 <h1 class="text-danger">{{session('error')}}</h1>
                            @endif
                            <div class="card-body">
                                <form method="post" action="#" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div style="padding: 1rem;background-color: #f1f1f1;">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Select Date</label>
                                                            <input id="datetimepicker" type="text" class="form-control" name="date" autocomplete="off" value="{{ date('Y/m/d') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Select Location</label>
                                                            <select class="form-control" name="location">
                                                                <option value="1">2101 - Electra</option>
                                                                <option value="2">2102 - Muroor</option>
                                                                <option value="3">2103 - Madina Zayed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Select Cashier</label>
                                                            <select class="form-control" name="cashier_id">
                                                                <option value="1">101010</option>
                                                                <option value="2">102030</option>
                                                                <option value="3">101121</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <button type="submit" class="btn btn-primary btn-draft">Show Data</button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <table class="tg">
                                                        <thead>
                                                          <tr>
                                                            <th class="tg-0lax text-center" colspan="5">
                                                                Head Cashier / In-Charge / Manager Hand Over Closing Sheet
                                                            </th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                          <tr>
                                                            <td class="tg-0lax text-center xxl-bold" colspan="5">
                                                                Mohammed Akter Supermarket LLC
                                                            </td>
                                                          </tr>
                                                          <tr style="background-color:yellow">
                                                            <td class="tg-0lax">
                                                                Location Code
                                                            </td>
                                                            <td class="tg-0lax">
                                                                <input type="text" name="loc_code">
                                                            </td>
                                                            <td class="tg-0lax">
                                                                Staff ID &nbsp;&nbsp;&nbsp;<input type="text" name="staff_id">
                                                            </td>
                                                            <td class="tg-0lax">
                                                                Audited By
                                                            </td>
                                                            <td class="tg-0lax">
                                                                <input type="text" name="audit_by">
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-right" colspan="4">
                                                                Audit / Hand Over Date :
                                                            </td>
                                                            <td class="tg-0lax">
                                                                <input type="text" name="date" value="{{ date('d/m/Y') }}">
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax xl-bold text-center" colspan="5">
                                                                Cash Closing Details
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax bold" colspan="4">
                                                                Petty Cash Fund / Sales on Hand (Coins Included)
                                                            </td>
                                                            <td class="tg-0lax text-right xxl-bold">
                                                                0.00
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax bold" colspan="4">
                                                                Cash Float Total
                                                            </td>
                                                            <td class="tg-0lax bold">
                                                                0.00
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax">
                                                                Number of POS
                                                            </td>
                                                            <td class="tg-0lax text-right">
                                                                <input type="text" name="pos_no">
                                                            </td>
                                                            <td class="tg-0lax">
                                                                Float Amount
                                                            </td>
                                                            <td class="tg-0lax text-right">
                                                                <input type="text" name="float_amount">
                                                            </td>
                                                            <td class="tg-0lax">
                                                                
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax xl-bold text-center" colspan="5">
                                                                Petty Cash Expense
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax" colspan="3">
                                                                1.<br>
                                                                2.<br>
                                                                3.
                                                            </td>
                                                            <td class="tg-0lax text-right">
                                                                0.00<br>
                                                                0.00<br>
                                                                0.00
                                                            </td>
                                                            <td class="tg-0lax">
                                                                
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax bold" colspan="3">
                                                                Total Expense From Petty Cash
                                                            </td>
                                                            <td class="tg-0lax text-right">
                                                                0.00
                                                            </td>
                                                            <td class="tg-0lax">
                                                                
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax bold" colspan="4">
                                                                Cash In Hand Should Be
                                                            </td>
                                                            <td class="tg-0lax bold">
                                                                0.00
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax xl-bold text-center" colspan="5">
                                                                Physical Cash Details
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-center bold">
                                                                Denominations
                                                            </td>
                                                            <td class="tg-0lax text-center bold">
                                                                *
                                                            </td>
                                                            <td class="tg-0lax text-center bold">
                                                                Qty
                                                            </td>
                                                            <td class="tg-0lax text-center bold">
                                                                Value
                                                            </td>
                                                            <td class="tg-0lax">
                                                                
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-center">
                                                                1000
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                *
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                <input type="text/css" value="0" name="">
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                0.00
                                                            </td>
                                                            <td class="tg-0lax">
                                                                
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-center">
                                                                500
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                *
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                <input type="text/css" value="0" name="">
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                0.00
                                                            </td>
                                                            <td class="tg-0lax">
                                                                
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-center">
                                                                200
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                *
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                <input type="text/css" value="0" name="">
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                0.00
                                                            </td>
                                                            <td class="tg-0lax">
                                                                
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-center">
                                                                100
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                *
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                <input type="text/css" value="0" name="">
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                0.00
                                                            </td>
                                                            <td class="tg-0lax">
                                                                
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-center">
                                                                50
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                *
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                <input type="text/css" value="0" name="">
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                0.00
                                                            </td>
                                                            <td class="tg-0lax">
                                                                
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-center">
                                                                20
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                *
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                <input type="text/css" value="0" name="">
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                0.00
                                                            </td>
                                                            <td class="tg-0lax">
                                                                
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-center">
                                                                10
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                *
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                <input type="text/css" value="0" name="">
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                0.00
                                                            </td>
                                                            <td class="tg-0lax">
                                                                
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-center">
                                                                5
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                *
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                <input type="text/css" value="0" name="">
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                0.00
                                                            </td>
                                                            <td class="tg-0lax">
                                                                
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-center">
                                                                1
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                *
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                <input type="text/css" value="0" name="">
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                0.00
                                                            </td>
                                                            <td class="tg-0lax">
                                                                
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-center">
                                                                0.50
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                *
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                <input type="text/css" value="0" name="">
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                0.00
                                                            </td>
                                                            <td class="tg-0lax">
                                                                
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-center">
                                                                0.25
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                *
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                <input type="text/css" value="0" name="">
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                0.00
                                                            </td>
                                                            <td class="tg-0lax">
                                                                
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax bold text-right" colspan="3">
                                                                Total Physical Cash
                                                            </td>
                                                            <td class="tg-0lax text-right">
                                                                0.00
                                                            </td>
                                                            <td class="tg-0lax">
                                                                
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax bold" colspan="4">
                                                                Actual Cash In Hand
                                                            </td>
                                                            <td class="tg-0lax bold">
                                                                0.00
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax xxl-bold" colspan="4">
                                                                Total Amount Found While Closing
                                                            </td>
                                                            <td class="tg-0lax text-right xxl-bold">
                                                                0.00
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax bold" colspan="4">
                                                                Shortage / Access
                                                            </td>
                                                            <td class="tg-0lax bold">
                                                                0.00
                                                            </td>
                                                          </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection

@push('js_script')

@endpush