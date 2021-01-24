@extends('layouts/app')

@section('title', 'Dashboard - Profit & Loss Report')

@section('main_content')
        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Profit & Loss Report</h5>
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
                                        <button type="buton" class="btn btn-primary btn-draft mt-3 btn-mark-paid">mark as paid</button>
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
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th><input class="sel" type="checkbox" value="all" onclick="checkAll('all')">
                                            </th>
                                            <th>Receive Date</th>
                                            <th>Location</th>
                                            <th>Reference</th>
                                            <th>Vendor</th>
                                            <th>Vendor Invoice</th>
                                            <th>Total Due</th>
                                            <th>Payment Date</th>
                                        </tr>

                                        
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                                <div>
                                    <button type="button" class="btn btn-primary btn-draft mt-3"><i class="fas fa-file-download"></i> &nbsp; Download PDF</button>
                                    <button type="button" class="btn btn-primary mt-3"><i class="fas fa-print"></i> &nbsp; print</button>
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
  var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        ajax: {
            url:"{{ route('unpaid_grn_data') }}",
            data: function(data){
                data.store_id = $('.ls-store-filter').val()
            }
       },
        lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "All"]],
        columns: [
        {data: 'checkbox', name: 'checkbox', orderable:false, searchable:false},
            {data: 'created_at', name: 'created_at'},
            {data: 'location', name: 'location'},
            {data: 'reference_no', name: 'reference_no'},
            // {data: 'total_items', name: 'total_items'},
            {data: 'vendor', name: 'vendor'},
            {data: 'vendor_invoice', name: 'vendor_invoice'},//
            {data: 'grand_total', name: 'grand_total'},
            {data: 'payment_date', name: 'payment_date'},
            // {data: 'received_by', name: 'received_by'},
            // {data: 'action', name: 'action', searchable: false, sortable:false},
        ],
        // initComplete: function () {
        //     this.api().columns().every(function (col) {
        //                             var column = this;
        //                             console.log(column);
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

    table.columns().every(function() {
    var that = this;
    $('#Requisition-range').on('keyup change', function() {
        if (that.search() == this.value) {
            that.search(this.value).draw();
        }
    });
});

    $('.store-filter a').on('click', function(){
        store_id=$(this).data('id');
        store_name = $(this).data('name');
        $('#loc-text').text('');
        $('#loc-text').text(store_name);
        $('.ls-store-filter').val(store_id);
        table.draw();
    });

    $('input[type="checkbox"]').click(function(){
        if($(this).val() == 'all'){
             $('input:checkbox').prop('checked', this.checked); 
        }
    });

    $('.btn-mark-paid').on('click', function(){
    let selected = $('input[name="count_history"]:checked').map(function(){
                 return $(this).val();
            }).get();

        $.ajax({
          type: "POST",
          url: "{{ route('lpo_mark_as_paid') }}",
          data: {'selected':selected},
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          cache: false,
          success: function(data){
             table.draw();
          }
        });

    });
    
</script>
@endpush