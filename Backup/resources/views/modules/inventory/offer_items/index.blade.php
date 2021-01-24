@extends("layouts.app")

@section("title", "Aweer Inventory - Offer")


@section("main_content")

        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Offer History(<span id="loc-text">All Locations</span>)</h5>
                                <div class="title-icons">
                                    <div class="dropdown show" style="display: inline-block;">
                                        <a class="dropdown-toggle" href="#" id="locationFilterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </a>

                                        <div class="dropdown-menu store-filter" aria-labelledby="locationFilterDropdown">
                                            <a class="dropdown-item" data-id="0"> <i class="fas fa-store-alt"></i>All Locations</a>                                            
                                            @foreach ($stores as $store)
                                               <a class="dropdown-item" data-id="{{ $store->id}}" data-name="{{ $store->name}}"><i class="fas fa-store-alt"></i> {{$store->name}}</a>
                                            @endforeach
                                        </div>
                                      <input type="hidden" name="store_filter" class="ls-store-filter" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Date</th>
                                            <th>Reference</th>
                                            <th>Item Code</th>
                                            <th>Barcode</th>
                                            <th>Unit</th>
                                            <th>Location</th>
                                            <th>Buy Product</th>
                                            <th>Get Product</th>
                                            <th>Note</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            <th>SL</th>
                                            <th>Date</th>
                                            <th>Reference</th>
                                            <th>Item Code</th>
                                            <th>Barcode</th>
                                            <th>Unit</th>
                                            <th>Location</th>
                                            <th>Buy Product</th>
                                            <th>Get Product</th>
                                            <th>Note</th>
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
        <!-- Item Delete Modal -->
        <div class="modal fade" id="itemDelModal" tabindex="-1" role="dialog" aria-labelledby="itemDelModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="itemDelModalLabel">Item Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                            <p>Want to delete the item?</p>
                            <div>
                                <input id="delete_id" type="hidden" name="delete_id">
                                <button type="button" class="btn btn-secondary mt-3" data-dismiss="modal">No</button>
                                <button type="button" onclick="confirmDelete()" class="btn btn-primary mt-3">Yes, Delete</button>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
@endsection


@push("js_script")
<script>
    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        ajax: {
            url:"{{ route('offer.list.data') }}",
            data: function(data){
                data.store_id = $('.ls-store-filter').val()
            }
       },
        lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "All"]],
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'date', name: 'date'},
            {data: 'reference', name: 'reference'},
            {data: 'code', name: 'code'},
            {data: 'barcode', name: 'barcode'},
            {data: 'unit', name: 'unit'},//
            {data: 'location', name: 'location'},
            {data: 'buy_product', name: 'buy_product'},
            {data: 'get_product', name: 'get_product'},

            {data: 'note', name: 'note'},
            {data: 'action', name: 'action'},
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


    function deleteData(id){
        $('#delete_id').val(id);

        $('#itemDelModal').modal('show');

    }

    function confirmDelete(){
        let id = $('#delete_id').val();
  
        $.ajax({
            url: "{{ route('item_offer_delete') }}",
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{'id':id},
            success: function(){
                table.draw();
                $('#itemDelModal').modal('hide');

            }
        });
    }
    $('.store-filter a').on('click', function(){
        store_id=$(this).data('id');
        store_name = $(this).data('name');
        $('#loc-text').text('');
        $('#loc-text').text(store_name);
        $('.ls-store-filter').val(store_id);
        table.draw();
    });
</script>
@endpush
