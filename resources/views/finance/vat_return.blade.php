@extends("layouts.app")

@section("title", "VAT Return Report")


@section("main_content")


<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;margin-bottom:30px;}
    .tg td{border-color:white;border-style:solid;border-width:0px;font-weight:bold;overflow:hidden;padding:2px 10px;word-break:normal;}
    .tg th{border-color:white;border-style:solid;border-width:0px;font-weight:bold;overflow:hidden;padding:2px 10px;word-break:normal;}
    .tg .tg-0lax{text-align:left;vertical-align:top}
    .text-right {text-align:right;}
    .text-center {text-align:center;}
</style>

        <main class="page-content" id="item-anatomy">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>VAT Return Report</h5>
                                <input style="width:300px;float:right" type="text" name="vat-range" class="form-control"/>
                            </div>
                            <div class="card-body">
                                <form style="min-height: 400px;max-width:80%">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="text-center">VAT Return</h4><br>
                                        </div>

                                        <div style="margin-left:10px" class="col-12 mt-1">
                                            <h5>Basic Information</h5>
                                            <strong>TRN</strong><br>
                                            <p>100523495800003</p>
                                            <span style="float:left;width:50%">
                                                <strong>Legal Name of Entity (English)</strong><br>
                                                <p>Mohammed Akter Supermarket L.L.C</p>
                                            </span>
                                            <span style="float:right;width:50%">
                                                <strong>Legal Name of Entity (Arabic)</strong><br>
                                                <p> سوبر ماركات محمد اختر ذ م م</p>
                                            </span>
                                            <strong>Address</strong><br>
                                            <address>Mohammed Akter Cash & Carry, Musaffa-44,<br>
                                            Musaffa, Abu Dhabi,<br>
                                            Abu Dhabi, United Arab Emirates,<br>
                                            8609, +97126652333</address>
                                        </div>

                                        <div style="margin-left:10px" class="col-12 mt-1">
                                            <h5>VAT Return Period</h5>
                                            <span style="float:left;width:50%">
                                                <strong>VAR Return Period</strong><br>
                                                <p>01/07/2020 - 30/09/2020</p>
                                                <strong>Tax Year End</strong><br>
                                                <p>31 March 2021</p>
                                            </span>
                                            <span style="float:right;width:50%">
                                                <strong>VAT Return Due Date</strong><br>
                                                <p>28/10/2020</p>
                                                <strong>VAT Return Period Reference Number</strong><br>
                                                <p>02 - 2021</p>
                                            </span>
                                        </div>

                                        <div style="margin-left:10px" class="col-12 mt-1">
                                            <h5>VAT on Sales and All Other Outputs</h5><br>
                                            <table class="tg">
                                            <thead>
                                              <tr>
                                                <th class="tg-0lax" colspan="2"></th>
                                                <th class="tg-0lax">Amount (AED)</th>
                                                <th class="tg-0lax">VAT Amount (AED)</th>
                                                <th class="tg-0lax">Adjustment (AED)</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td class="tg-0lax">1a</td>
                                                <td class="tg-0lax" width="320">Stadard rated supplies in Abu Dhabi</td>
                                                <td class="tg-0lax text-right" width="150">19,725,634.29</td>
                                                <td class="tg-0lax text-right">906,654.51</td>
                                                <td class="tg-0lax text-right">0.00</td>
                                              </tr>
                                              <tr>
                                                <td class="tg-0lax">1b</td>
                                                <td class="tg-0lax" width="320">Stadard rated supplies in Dubai</td>
                                                <td class="tg-0lax text-right" width="150">0.00</td>
                                                <td class="tg-0lax text-right">0.00</td>
                                                <td class="tg-0lax text-right">0.00</td>
                                              </tr>
                                              <tr>
                                                <td class="tg-0lax">1c</td>
                                                <td class="tg-0lax" width="320">Stadard rated supplies in Sharjah</td>
                                                <td class="tg-0lax text-right" width="150">663,462.86</td>
                                                <td class="tg-0lax text-right">32,568.64</td>
                                                <td class="tg-0lax text-right">0.00</td>
                                              </tr>
                                              <tr>
                                                <td class="tg-0lax">1d</td>
                                                <td class="tg-0lax" width="320">Stadard rated supplies in Ajman</td>
                                                <td class="tg-0lax text-right" width="150">783,850.48</td>
                                                <td class="tg-0lax text-right">37,526.62</td>
                                                <td class="tg-0lax text-right">0.00</td>
                                              </tr>
                                              <tr>
                                                <td class="tg-0lax">1e</td>
                                                <td class="tg-0lax" width="320">Stadard rated supplies in Umm Al Quwain</td>
                                                <td class="tg-0lax text-right" width="150"></td>
                                                <td class="tg-0lax text-right"></td>
                                                <td class="tg-0lax text-right"></td>
                                              </tr>
                                              <tr>
                                                <td class="tg-0lax">1f</td>
                                                <td class="tg-0lax" width="320">Stadard rated supplies in Ras Al Khaimah</td>
                                                <td class="tg-0lax text-right" width="150">0.00</td>
                                                <td class="tg-0lax text-right">0.00</td>
                                                <td class="tg-0lax text-right">0.00</td>
                                              </tr>
                                              <tr>
                                                <td class="tg-0lax">1g</td>
                                                <td class="tg-0lax" width="320">Stadard rated supplies in Fujairah</td>
                                                <td class="tg-0lax text-right" width="150">0.00</td>
                                                <td class="tg-0lax text-right">0.00</td>
                                                <td class="tg-0lax text-right">0.00</td>
                                              </tr>
                                              <tr>
                                                <td class="tg-0lax">2</td>
                                                <td class="tg-0lax" width="320">Tax Refunds provided to Tourists under the Tax Refunds for Tourists Scheme</td>
                                                <td class="tg-0lax text-right" width="150">0.00</td>
                                                <td class="tg-0lax text-right">0.00</td>
                                                <td class="tg-0lax text-right">0.00</td>
                                              </tr>
                                              <tr>
                                                <td class="tg-0lax">3</td>
                                                <td class="tg-0lax" width="320">Supplies subject to the reverse charge provisions</td>
                                                <td class="tg-0lax text-right" width="150">0.00</td>
                                                <td class="tg-0lax text-right">0.00</td>
                                                <td class="tg-0lax text-right">0.00</td>
                                              </tr>
                                              <tr>
                                                <td class="tg-0lax">4</td>
                                                <td class="tg-0lax" width="320">Zero rated supplies</td>
                                                <td class="tg-0lax text-right" width="150">1,625,862.00</td>
                                                <td class="tg-0lax text-right"></td>
                                                <td class="tg-0lax text-right"></td>
                                              </tr>
                                              <tr>
                                                <td class="tg-0lax">5</td>
                                                <td class="tg-0lax" width="320">Exempt supplies</td>
                                                <td class="tg-0lax text-right" width="150">0.00</td>
                                                <td class="tg-0lax text-right"></td>
                                                <td class="tg-0lax text-right"></td>
                                              </tr>
                                              <tr>
                                                <td class="tg-0lax">6</td>
                                                <td class="tg-0lax" width="320">Goods imported into the UAE</td>
                                                <td class="tg-0lax text-right" width="150">0.00</td>
                                                <td class="tg-0lax text-right">0.00</td>
                                                <td class="tg-0lax text-right"></td>
                                              </tr>
                                              <tr>
                                                <td class="tg-0lax">7</td>
                                                <td class="tg-0lax" width="320">Adjustments to goods imported into the UAE</td>
                                                <td class="tg-0lax text-right" width="150">0.00</td>
                                                <td class="tg-0lax text-right">0.00</td>
                                                <td class="tg-0lax text-right"></td>
                                              </tr>
                                              <tr>
                                                <td class="tg-0lax">8</td>
                                                <td class="tg-0lax" width="320">Totals</td>
                                                <td class="tg-0lax text-right" width="150">22,798,809.63</td>
                                                <td class="tg-0lax text-right">976,749.77</td>
                                                <td class="tg-0lax text-right">0.00</td>
                                              </tr>
                                              <tr style="height:30px"></tr>
                                              <tr>
                                                  <td class="tg-0lax" colspan="5">
                                                      <h5>VAT on Expenses and All Other Inputs</h5><br>
                                                  </td>
                                              </tr>
                                              <tr>
                                                <td class="tg-0lax">9</td>
                                                <td class="tg-0lax" width="320">Standard rated expenses</td>
                                                <td class="tg-0lax text-right" width="150">2,832,878.50</td>
                                                <td class="tg-0lax text-right">141,643.93</td>
                                                <td class="tg-0lax text-right"></td>
                                              </tr>
                                              <tr>
                                                <td class="tg-0lax">10</td>
                                                <td class="tg-0lax" width="320">Supplies subject to the reverse charge provisions</td>
                                                <td class="tg-0lax text-right" width="150">22,038,871.57</td>
                                                <td class="tg-0lax text-right">810,703.17</td>
                                                <td class="tg-0lax text-right"></td>
                                              </tr>
                                              <tr>
                                                <td class="tg-0lax">11</td>
                                                <td class="tg-0lax" width="320">Totals</td>
                                                <td class="tg-0lax text-right" width="150">24,871,750.07</td>
                                                <td class="tg-0lax text-right">952,347.10</td>
                                                <td class="tg-0lax text-right">0.00</td>
                                              </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                        
                                        <div style="margin-left:10px" class="col-12 mt-1">
                                            <h5>Net VAT Due</h5>
                                            <strong>12 &nbsp;&nbsp;&nbsp;Total value of due tax for the period</strong><br>
                                            <p>976,749.77</p>
                                            <strong>13 &nbsp;&nbsp;&nbsp;Total value of recoverable tax for the period</strong><br>
                                            <p>952,347.10</p>
                                            <strong>14 &nbsp;&nbsp;&nbsp;Payable tax for the period</strong><br>
                                            <p>24,402.67</p>
                                        </div>
                                        
                                        <div style="margin-left:10px" class="col-12 mt-1">
                                            <h5>Additional Reporting Requirements</h5>
                                            <span style="margin-left:30px;display:block;width:100%">
                                                <h5>Profit Margin Scheme</h5>
                                                <strong>Did you apply the orofit margin scheme in respect of any supplies made during the tax period?</strong><br>
                                                <strong>No</strong>
                                            </span>
                                        </div>
                                        
                                        <div style="margin-top:60px;margin-left:10px" class="col-12">
                                            <h5>Authorised Signatory</h5>
                                            <span style="float:left;width:50%">
                                                <strong>Name in English</strong><br>
                                                <p>Mohammed Akter Hossian Romiz Ahmed</p>
                                                <strong>Phone / Mobile Country Code</strong><br>
                                                <p>United Arab Emirates (+971)</p>
                                                <strong>Date of Submission</strong><br>
                                                <p>21/10/2020</p>
                                            </span>
                                            <span style="float:right;width:50%">
                                                <strong>Name in Arabic</strong><br>
                                                <p></p>
                                                <strong>Phone / Mobile Number</strong><br>
                                                <p>506278741</p>
                                                <strong>Email Address</strong><br>
                                                <p>masreg01@gmail.com</p>
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" v-on:click="generatePdf" class="btn btn-primary btn-draft mt-3">Download as PDF</button>
                                        <button type="button" class="btn btn-primary mt-3">Print</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

@endsection


@push("js_script")
<script>

table.columns().every(function() {
    var that = this;
    $('#vat-range').on('keyup change', function() {
        if (that.search() == this.value) {
            that.search(this.value).draw();
        }
    });
});

</script>
@endpush
