@extends('layouts/app')

@section('title', 'Dashboard - Daily Cash Closing')

@section('main_content')

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;width:100%;}
.tg input {border:0;text-align:center;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:12px;
  overflow:hidden;padding:0 20px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:20px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-0lax{text-align:left;vertical-align:top}

.tg2  {border-collapse:collapse;border-spacing:0;width:100%;}
.tg2 input {border:0;text-align:center;max-width:40px;}
.tg2 td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:12px;
  overflow:hidden;padding:0 2px;word-break:normal;}
.tg2 th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:20px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg2 .tg-0lax{text-align:left;vertical-align:top}

.tg3  {border-collapse:collapse;border-spacing:0;width:100%;}
.tg3 input {border:0;text-align:center;max-width:70px;}
.tg3 td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:12px;
  overflow:hidden;padding:0 2px;word-break:normal;}
.tg3 th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:20px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg3 .tg-0lax{text-align:left;vertical-align:top}

.text-center {text-align:center;}
.text-right {text-align:right;}
.xxl-bold {font-weight:bold;font-size:16px!important;}
.xl-bold {font-weight:bold;font-size:14px!important;}
.bold {font-weight:bold;font-size:13px!important;}
.mt-50 {padding:50px!important;}
</style>

        <main class="page-content" id="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Daily Cash Closing</h5>
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
                                                            <th class="tg-0lax text-center" colspan="9">
                                                                Mohammed Akter Supermarket LLC
                                                            </th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                          <tr>
                                                            <td class="tg-0lax text-center xl-bold" colspan="9">
                                                                Daily Cash Closing Details
                                                            </td>
                                                          </tr>
                                                          <tr style="background-color:yellow">
                                                            <td class="tg-0lax" colspan="2">
                                                                Enter Location Code
                                                            </td>
                                                            <td class="tg-0lax">
                                                                <input type="text" name="loc_code">
                                                            </td>
                                                            <td class="tg-0lax" colspan="2">
                                                                Enter Cashier ID
                                                            </td>
                                                            <td class="tg-0lax" colspan="2">
                                                                <input type="text" name="cashier_id">
                                                            </td>
                                                            <td class="tg-0lax text-right">
                                                                Cash Closing Date
                                                            </td>
                                                            <td class="tg-0lax">
                                                                <?php echo date('d-M-Y');?>
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-center xl-bold" colspan="4">
                                                                Float Cash Denominations
                                                            </td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax text-center  xl-bold" colspan="4">
                                                                Sales Cash Denominations
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-center" colspan="2">
                                                                Denomination
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                Nos
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                Value
                                                            </td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax text-center" colspan="2">
                                                                Denomination
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                Nos
                                                            </td>
                                                            <td class="tg-0lax text-center">
                                                                Value
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax">1000</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax">1000</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax">500</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax">500</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax">200</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax">200</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax">100</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax">100</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax">50</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax">50</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax">20</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax">20</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax">10</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax">10</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax">5</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax">5</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax">1</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax">1</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax">0.50</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax">0.50</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax">0.25</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax">0.25</td>
                                                            <td class="tg-0lax">*</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax">0</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-right xl-bold" colspan="3">
                                                                Total Float Cash (Dhs)
                                                            </td>
                                                            <td class="tg-0lax">
                                                                0
                                                            </td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax text-right xl-bold" colspan="3">
                                                                Total Sales Cash (Dhs)
                                                            </td>
                                                            <td class="tg-0lax">
                                                                0
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-right" colspan="8">
                                                                Float Money (-)
                                                            </td>
                                                            <td class="tg-0lax">0.00</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-right" colspan="8">
                                                                Net Cash (=)
                                                            </td>
                                                            <td class="tg-0lax">0.00</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-right" colspan="8">
                                                                Credit Sales (+)
                                                            </td>
                                                            <td class="tg-0lax">0.00</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-right" colspan="8">
                                                                Total Sales (=)
                                                            </td>
                                                            <td class="tg-0lax">0.00</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-right" colspan="8">
                                                                Cash To Credit (+)
                                                            </td>
                                                            <td class="tg-0lax">0.00</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-right" colspan="8">
                                                                Sub Total (=)
                                                            </td>
                                                            <td class="tg-0lax">0.00</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax" colspan="9"></td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax" colspan="4"></td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax text-right xl-bold" colspan="3">
                                                                Particulars
                                                            </td>
                                                            <td class="tg-0lax xl-bold">
                                                                Dhs / Fils
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-center xxl-bold" colspan="4">
                                                                Undertaking
                                                            </td>
                                                            <td class="tg-0lax">
                                                                
                                                            </td>
                                                            <td class="tg-0lax text-right" colspan="3">
                                                                Total Cash Punched
                                                            </td>
                                                            <td class="tg-0lax">0.00</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-center xl-bold" colspan="4">
                                                                I’m Fully Responsible for the Shortage
                                                            </td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax text-right" colspan="3">
                                                                Credit To Cash
                                                            </td>
                                                            <td class="tg-0lax">0.00</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-right" colspan="2">
                                                                Amount of AED
                                                            </td>
                                                            <td class="tg-0lax" colspan="2">0.00</td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax text-right" colspan="3">
                                                                Refund / Return (-)
                                                            </td>
                                                            <td class="tg-0lax">0.00</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax" colspan="4"></td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax text-right" colspan="3">
                                                                Sub Total (=)
                                                            </td>
                                                            <td class="tg-0lax">0.00</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax" colspan="4" rowspan="4">
                                                                Signature
                                                            </td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax text-right" colspan="3">
                                                                Cash (+Excess+)/(-Cash short-)±
                                                            </td>
                                                            <td class="tg-0lax">0.00</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax text-right" colspan="3">
                                                                Net Cash Sales
                                                            </td>
                                                            <td class="tg-0lax">0.00</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax text-right" colspan="3">
                                                                Credit Card Settlement Amount
                                                            </td>
                                                            <td class="tg-0lax">0.00</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax" colspan="2"></td>
                                                            <td class="tg-0lax" colspan="2"></td>
                                                          </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row">
                                                    <table class="tg2">
                                                        <thead>
                                                          <tr>
                                                            <th class="tg-0lax text-center" colspan="18">
                                                                Telephone Card Sales
                                                            </th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                          <tr>
                                                            <td class="tg-0lax bold">Particulars</td>
                                                            <td class="tg-0lax bold">E-15</td>
                                                            <td class="tg-0lax bold">E-30</td>
                                                            <td class="tg-0lax bold">E-55</td>
                                                            <td class="tg-0lax bold">E-110</td>
                                                            <td class="tg-0lax bold">F-15</td>
                                                            <td class="tg-0lax bold">F-20</td>
                                                            <td class="tg-0lax bold">F-30</td>
                                                            <td class="tg-0lax bold">F-50</td>
                                                            <td class="tg-0lax bold">DU-25</td>
                                                            <td class="tg-0lax bold">DU-55</td>
                                                            <td class="tg-0lax bold">DU-110</td>
                                                            <td class="tg-0lax bold">H-15</td>
                                                            <td class="tg-0lax bold">H-30</td>
                                                            <td class="tg-0lax bold">H-50</td>
                                                            <td class="tg-0lax bold">EMB-50</td>
                                                            <td class="tg-0lax bold">DMB-50</td>
                                                            <td class="tg-0lax bold">Total</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax bold">Opening Balance</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax bold">Cashier Receive</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax bold">Total</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax bold">Sales</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax bold">Transfer</td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax bold">Closing Balance</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax bold">S.Amount</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                            <td class="tg-0lax">0</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-right bold" colspan="17">Grand Total</td>
                                                            <td class="tg-0lax">0.00</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-right bold" colspan="17">Short / Over</td>
                                                            <td class="tg-0lax">0.00</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax" colspan="18"></td>
                                                          </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row">
                                                    <table class="tg3">
                                                        <thead>
                                                          <tr>
                                                            <th class="tg-0lax text-center" colspan="12">
                                                                Departmentwise Daily Sales Data
                                                            </th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                          <tr>
                                                            <td class="tg-0lax">1 - Gro F.</td>
                                                            <td class="tg-0lax">2 - Dairy</td>
                                                            <td class="tg-0lax">3 - Frozen</td>
                                                            <td class="tg-0lax">4 - Butcher</td>
                                                            <td class="tg-0lax">5 - F & V</td>
                                                            <td class="tg-0lax">6 - Tobacco</td>
                                                            <td class="tg-0lax">7 - Gro NF</td>
                                                            <td class="tg-0lax">8 - Electro.</td>
                                                            <td class="tg-0lax">9 - Mobile</td>
                                                            <td class="tg-0lax">10 - Tele Card</td>
                                                            <td class="tg-0lax">11 - Watch</td>
                                                            <td class="tg-0lax">12 - Perf. Jew.</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax">13 - Toys</td>
                                                            <td class="tg-0lax">14 - Garm. Text.</td>
                                                            <td class="tg-0lax">15 - Footwr</td>
                                                            <td class="tg-0lax">16 - Station.</td>
                                                            <td class="tg-0lax">17 - Househld</td>
                                                            <td class="tg-0lax">18 - Luggage</td>
                                                            <td class="tg-0lax">19 - Srv. Item</td>
                                                            <td class="tg-0lax">20 - Consgn.</td>
                                                            <td class="tg-0lax">21 - Bever.</td>
                                                            <td class="tg-0lax">22 - Delicat.</td>
                                                            <td class="tg-0lax">23 - Fishery</td>
                                                            <td class="tg-0lax">24 - Lawn Gard.</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                            <td class="tg-0lax"><input type="text" name=""></td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-right bold" colspan="11">Total</td>
                                                            <td class="tg-0lax">0.00</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax mt-50" colspan="12"></td>
                                                          </tr>
                                                          <tr>
                                                            <td class="tg-0lax text-center" colspan="2">Cashier</td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax text-center" colspan="2">Head Cashier</td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax text-center" colspan="2">LPO / Security</td>
                                                            <td class="tg-0lax"></td>
                                                            <td class="tg-0lax text-center" colspan="3">Manager / Superviser</td>
                                                          </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row">
                                                    <div class="offset-md-9 col-md-3 text-right">
                                                        <button type="submit" class="btn btn-primary btn-draft mt-3">Save & Print</button>
                                                    </div>
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