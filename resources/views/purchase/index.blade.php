@extends('layouts/app')

@section('title', 'Dashboard - Purchase List')

@section('main_content')
        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Purchase List(<span id="loc-text">All Locations</span>)</h5>
                                <div class="title-icons">
                                    <div class="dropdown show" style="display: inline-block;">
                                        <a class="dropdown-toggle" href="#" id="locationFilterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </a>

                                        <div class="dropdown-menu store-filter" aria-labelledby="locationFilterDropdown">
                                            <a class="dropdown-item" data-id="0"> <i class="fas fa-store-alt"></i> All Locations</a>
                                            @foreach ($stores as $store)
                                               <a class="dropdown-item" data-id="{{ $store->id}}" data-name="{{ $store->name}}"><i class="fas fa-store-alt"></i> {{$store->name}}</a>
                                            @endforeach
                                      </div>
                                      <input type="hidden" name="store_filter" class="ls-store-filter" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div style="width: 20%">
                                    <div class="form-group">
                                        <label>Select Date Range</label>
                                        <input type="text" name="vegrequisition-range" id="requisition_range" class="form-control"/>
                                    </div>
                                </div>
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Requisition Date</th>
                                            <th>Vendor Date</th>
                                            <th>Shipping Date</th>
                                            <th>Reference</th>
                                            <th>Vendor</th>
                                            <th>FOC Items</th>
                                            <th>Purchase Status</th>
                                            <th>Tax</th>
                                            <th>Discount</th>
                                            <th>Grand Total</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr id="vegRequisitionfilterrow">
                                            <th>Date</th>
                                            <th>Requisition Date</th>
                                            <th>Vendor Date</th>
                                            <th>Shipping Date</th>
                                            <th>Reference</th>
                                            <th>Vendor</th>
                                            <th>FOC Items</th>
                                            <th>Purchase Status</th>
                                            <th>Tax</th>
                                            <th>Discount</th>
                                            <th>Grand Total</th>
                                            <th>Action</th>
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

        <!-- Status Update Modal -->
        <div class="modal fade" id="statusUpdateModal" tabindex="-1" role="dialog" aria-labelledby="statusUpdateModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusUpdateModalLabel">Status Update Requisition</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <form>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control">
                                    <option>Pending</option>
                                    <option>Sent</option>
                                </select>
                            </div>
                            <div>
                                <button type="button" class="btn btn-secondary mt-3" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary mt-3">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Item Delete Modal -->
        <div class="modal fade" id="requisitionDelModal" tabindex="-1" role="dialog" aria-labelledby="requisitionDelModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="requisitionDelModalLabel">Delete Requisition</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <form>
                            <p>Want to delete the requisition?</p>
                            <div>
                                <button type="button" class="btn btn-secondary mt-3" data-dismiss="modal">No</button>
                                <button type="button" class="btn btn-primary mt-3">Yes, Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      
@endsection

@push('js_script')

<script>
 $(document).ready(function () {
    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        //ajax: "{{ route('purchase_order_list') }}",
        ajax: {
            url:"{{ route('purchase_order_list') }}",
            data: function(data){
                data.store_id = $('.ls-store-filter').val(),
                data.date_range = $('input[name="vegrequisition-range"]').val()
            }
       },
        lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "All"]],
        columns: [
            {data: 'date', name: 'date'},
            {data: 'requisition_date', name: 'requisition_date'},
            {data: 'vendor_confirm_date', name: 'vendor_confirm_date'},
            {data: 'shipping_date', name: 'shipping_date'},
            {data: 'reference', name: 'reference'},
            {data: 'vendor', name: 'vendor'},
            {data: 'foc_items', name: 'foc_items'},
            {data: 'status', name: 'status'},//
            {data: 'tax', name: 'tax'},//
            {data: 'discount', name: 'discount'},//
            {data: 'grand_total', name: 'grand_total'},
            {data: 'action', name: 'action', searchable: false, sortable:false},
        ],
        initComplete: function () {
            this.api().columns().every(function (col) {
                                    var column = this;
                                    console.log(column);
                if(col != 10){

                    var input = document.createElement("input");
                    input.placeholder = "Search";
                    input.className  = "form-control";
                    $(input).appendTo($(column.header()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                }else{
                    $('').appendTo($(column.header()).empty())
                }

            });
        }

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

$('input[name="vegrequisition-range"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {

    table.draw();
  });

});

</script>
@endpush