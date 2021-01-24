@extends("layouts.app")

@section("title", "Aweer Inventory - Department")


@section("main_content")
       <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>zone count history(<span id="loc-text">All Locations</span>)</h5>
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
                                <button class="btn btn-sm btn-damage">Damage</button>
                                <button class="btn btn-sm btn-adjustment">Adjustment</button>
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th><input class="sel" type="checkbox" value="all" onclick="checkAll('all')"></th>
                                            <th>Location</th>
                                            <th>Item (Item Code)</th>
                                            <th>Zone</th>
                                            <th>Stock</th>
                                            <th>Counted Stock</th>
                                            <th>Variance</th>
                                            <th>Status</th>
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

@endsection


@push("js_script")
<script>
    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        // columnDefs: [ {
        //     orderable: false,
        //     className: 'select-checkbox',
        //     targets:   0
        // } ],
        // select: {
        //     style:    'os',
        //     selector: 'td:first-child'
        // },
       // ajax: "{{ route('zone_count.list.data') }}",
        ajax: {
            url:"{{ route('zone_count.list.data') }}",
            data: function(data){
                data.store_id = $('.ls-store-filter').val()
            }
       },
        lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "All"]],
        columns: [

            {data: 'checkbox', name: 'checkbox', orderable:false, searchable:false},
            {data: 'location', name: 'location'},
            {data: 'item', name: 'item'},
            {data: 'zone', name: 'zone'},
            {data: 'stock', name: 'stock'},
            {data: 'counted_stocks', name: 'counted_stocks'},//
            {data: 'variance', name: 'variance'},

            {data: 'status', name: 'status'}
        ],

    });


    // $('.sel').on('clicked', function(){
    //     selected = $(this).val();
    //     alert(selected);
    // });
    $('input[type="checkbox"]').click(function(){
        if($(this).val() == 'all'){
             $('input:checkbox').prop('checked', this.checked); 
        }
    });
    $('.store-filter a').on('click', function(){
        store_id=$(this).data('id');
        $('.ls-store-filter').val(store_id);
        table.draw();
    });


    $('.btn-damage').on('click', function(){
    // let selected = $('input[name="count_history"]:checked').serialize();
    let selected = $("input:checkbox:checked").map(function(){
                 return $(this).val();
            }).get();

        $.ajax({
          type: "POST",
          url: "{{ route('make_damage') }}",
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

    $('.btn-adjustment').on('click', function(){
        let selected = $("input:checkbox:checked").map(function(){
                return $(this).val();
            }).get();
        $.ajax({
          type: "POST",
          url: "{{ route('make_adjustment') }}",
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
