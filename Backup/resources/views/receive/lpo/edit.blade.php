@extends('layouts/app')

@section('title', 'Dashboard - Vegetable Requisition Create')

@section('main_content')

      <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Receive LPO</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col-12">
                                            <div style="padding: 1rem;background-color: #f1f1f1;">
                                                <div class="row">
                                                    <div class="col-md-9 col-sm-12">
                                                        <div class="form-group">
                                                            <div class="input-group flex-nowrap">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-barcode"></i></span>
                                                                </div>
                                                                <select class="item-select form-control">
                                                                    <option></option>
                                                                    <option>siraj uddin</option>
                                                                    <option>miraj uddin</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Item Code</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Unit Cost</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Quantity</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Discount</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Shelf Life</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Expiry Date</label>
                                                            <input id="datetimepicker" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="button" class="btn btn-primary mt-4">Send</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 mt-3">
                                            <table class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Reference</th>
                                                        <th>Payment date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>15-05-2020</td>
                                                        <td>8wewerewr</td>
                                                        <td>12-05-2020</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <h5>Purchase Order</h5>
                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <div style="padding: 1rem;background-color: #f1f1f1;">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label>Vendor</label>
                                                        <input type="text" class="form-control" value="123543-Tomij Uddin Sarker">
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-group input-group-sm col-md-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Discount Term</span>
                                                            </div>
                                                            <input type="text" class="form-control" value="30%" readonly="">
                                                        </div>
                                                        <div class="input-group input-group-sm col-md-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Payment Term</span>
                                                            </div>
                                                            <input type="text" class="form-control" value="30 days" readonly="">
                                                        </div>
                                                        <div class="input-group input-group-sm col-md-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Vendor Type</span>
                                                            </div>
                                                            <input type="text" class="form-control" value="Principle" readonly="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-1">
                                        <div style="padding: 1rem;background-color: #f1f1f1">
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-striped table-bordered" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Item name (Item code)</th>
                                                                <th>Last GRN Cost</th>
                                                                <th>Final Cost</th>
                                                                <th>Quantity</th>
                                                                <th>Discount</th>
                                                                <th>Subtotal(AED)</th>
                                                                <th><a href="#"><i class="far fa-trash-alt"></i></a></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>101052 - AL DHAFRA DATES DABBAS 1KG</td>
                                                                <td>8</td>
                                                                <td><input type="number" class="form-control"></td>
                                                                <td><input type="number" class="form-control"></td>
                                                                <td><input type="number" class="form-control"></td>
                                                                <td>250</td>
                                                                <td><a href="#"><i class="far fa-window-close"></i></a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="col-md-2 float-right">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Discount</span>
                                                            </div>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="input-group input-group-sm mt-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Tax</span>
                                                            </div>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="total-requision mt-2">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                              <td>Total Items <span>0</span></td>
                                              <td>Total Quantity <span>0</span></td>
                                              <td>Grand Total <span>0</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection

@push('js_script')

<script>

const app = new Vue({
    el: '#page-content',
    data: {
        test: 'testing',
    },
    methods:{

    },
    created: function(){

    }

});


	
</script>
@endpush