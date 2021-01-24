@extends("layouts.app")

@section("title", "Transfer")


@section("main_content")

        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mt-3 text-right">
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-secondary">Edit</button>
                          <button type="button" class="btn btn-secondary">Print</button>
                          <button type="button" class="btn btn-secondary">Download</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Mohammed Akter Supermarket LLC</h5>
                                        <p>PO Box: 8603, Musaffah-44</p>
                                        <p>Tel: 02-5511402, Abu Dhabi</p>
                                        <p><b>TRN: 100523495800003</b></p>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="" alt="logo">
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <img src="https://5a135-0f-akt3r-9r0up.com/admin/misc/barcode/UlFTTjAxMDAwMjQ2/code128/74/0/1" alt="RQSN01000246" class="bcimg">
                                        <br>
                                        <p class="doc-no">*TRN12345678*</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="pt-3 pb-1 pl-2 pr-2">
                                            Transfer From: <br>
                                            <address>
                                                <h5>6016 - Aweer Fruits & Vegetables</h5>
                                                Dubai
                                            </address>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <div class="pt-3 pb-1 pl-2 pr-2">
                                            Transfer To <br>
                                            <address>
                                                <h5>2101 - Electra</h5>
                                                Abu Dhabi
                                            </address>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="simple-table">
                                            <thead>
                                                <th>Created By</th>
                                                <th>Date & Time</th>
                                                <th>Updated By</th>
                                                <th>Date & Time</th>
                                                <th>Status</th>
                                            </thead>
                                            <tbody>
                                                <td>Rakim Khan</td>
                                                <td>16/08/2020 14:25</td>
                                                <td>Mazhar</td>
                                                <td>16/08/2020 17:52</td>
                                                <td><span class="badge badge-warning">Draft</span></td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Item name (Item code)</th>
                                                    <th>Unit Cost</th>
                                                    <th>Quantity</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>101052 - AL DHAFRA DATES DABBAS 1KG</td>
                                                    <td>5</td>
                                                    <td>10</td>
                                                    <td>50</td>
                                                </tr>
                                                <tr>
                                                    <td>101052 - AL DHAFRA DATES DABBAS 1KG</td>
                                                    <td>5</td>
                                                    <td>10</td>
                                                    <td>50</td>
                                                </tr>
                                                <tr>
                                                    <td>101052 - AL DHAFRA DATES DABBAS 1KG</td>
                                                    <td>5</td>
                                                    <td>10</td>
                                                    <td>50</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" style="text-align:right; padding-right:10px;">Total
                                                    </td>
                                                    <td style="text-align:right; padding-right:10px;">150.00 AED</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align:right; padding-right:10px;">(+) Shipment Cost
                                                    </td>
                                                    <td style="text-align:right; padding-right:10px;">0.00 AED</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align:right; padding-right:10px;">(=) Net Total
                                                    </td>
                                                    <td style="text-align:right; padding-right:10px;">150.00 AED</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card bg-light pt-3 pb-1 pl-2 pr-2">
                                                    <h6>Note (6016)</h6>
                                                    <p>
                                                        Sender Comments
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card bg-light text-right pt-3 pb-1 pl-2 pr-2">
                                                    <h6>Note (2101)</h6>
                                                    <p>
                                                        Receiver Comments
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-4">
                                                <span>______________________</span><br>
                                                <span class="bold">Created By</span>
                                            </div>
                                            <div class="col-4 text-center">
                                                <span>______________________</span><br>
                                                <span class="bold">Checked By</span>
                                            </div>
                                            <div class="col-4 text-right">
                                                <span>______________________</span><br>
                                                <span class="bold">Received By</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection


@push("js_script")

@endpush
