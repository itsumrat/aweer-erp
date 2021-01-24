@extends('layouts/app')

@section('title', 'Dashboard - Vegetable Requisition Create')

@section('main_content')

        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>vendor transaction (All Locations)</h5>
                                <div class="title-icons">
                                    <div class="dropdown show" style="display: inline-block;">
                                        <a class="dropdown-toggle" href="#" id="locationFilterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="locationFilterDropdown">
                                            <a class="dropdown-item" href="#"><i class="fas fa-store-alt"></i> All Locations</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-store-alt"></i> Another action</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-store-alt"></i> Something else here</a>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <button type="buton" class="btn btn-primary btn-draft mt-3">make payment voucher</button>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Select Date Range</label>
                                            <input type="text" name="lpo-range" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Vendor</label>
                                        <div class="form-group">
                                            <select class="vendor-select form-control">
                                                <option></option>
                                               <option>121212-siraj uddin</option>
                                               <option>454545-miraj uddin</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- <table id="vtransactiontableView" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>checkbox</th>
                                            <th>Transaction Date</th>
                                            <th>Reference</th>
                                            <th>Vendor</th>
                                            <th>Vendor Invoice</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr id="vtransactionfilterrow">
                                            <th>checkbox</th>
                                            <th>Transaction Date</th>
                                            <th>Reference</th>
                                            <th>Vendor</th>
                                            <th>Vendor Invoice</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table> --}}
                                <table id="vtransactiontableView" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th><input class="sel" type="checkbox" value="all" onclick="checkAll('all')">
                                            </th>
                                            <th>Transaction Date</th>
                                            <th>Reference</th>
                                            <th>Vendor</th>
                                            <th>Vendor Invoice</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Action</th>
                                        </tr>

                                        
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
      <!-- page-content" -->
      
@endsection

@push('js_script')

<script>

// const app = new Vue({
//     el: '#page-content',
//     data: {
//         test: 'testing',
//     },
//     methods:{

//     },
//     created: function(){

//     }

// });

var table = $('#vtransactiontableView').DataTable({
        processing: false,
        serverSide: true,
        scrollX: true,
        ajax: {
            url:"{{ route('vendor_transaction_view') }}",
            data: function(data){
            }
       },
        lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "All"]],
        columns: [
        {data: 'checkbox', name: 'checkbox', orderable:false, searchable:false},
            {data: 'date', name: 'transaction date'},
            {data: 'reference', name: 'reference'},
            {data: 'vendor', name: 'vendor'},
            {data: 'location', name: 'vendor invoice'},
            {data: 'status', name: 'debit'},//
            {data: 'grand_total', name: 'credit'},
            {data: 'action', name: 'action', searchable: false, sortable:false},
        ],
        // initComplete: function () {
        //     this.api().columns().every(function (col) {
        //                             var column = this;
        //                             //console.log(column);
        //         if(col != 10){

        //             var input = document.createElement("input");
        //             input.placeholder = "Search";
        //             input.className  = "form-control";
        //             $(input).appendTo($(column.header()).empty())
        //             .on('keyup', function () {
        //                 column.search($(this).val(), false, false, true).draw();
        //             });
        //         }else{
        //             $('').appendTo($(column.header()).empty())
        //         }

        //     });
        // }

    });

    $('input[type="checkbox"]').click(function(){
        if($(this).val() == 'all'){
             $('input:checkbox').prop('checked', this.checked); 
        }
    });

    
</script>
@endpush