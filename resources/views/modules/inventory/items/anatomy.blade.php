@extends("layouts.app")

@section("title", "Aweer Inventory - Track Item")


@section("main_content")


        <main class="page-content" id="item-anatomy">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Track Items (<span id="loc-text">All Locations</span>)</h5>
                                <div class="title-icons">
                                    <div class="dropdown show">
                                        <a class="dropdown-toggle" href="#" id="locationFilterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </a>

                                        <div class="dropdown-menu store-filter" aria-labelledby="locationFilterDropdown">
                                            <a class="dropdown-item" data-id="0"> <i class="fas fa-store-alt" ></i>All Location</>                                            
                                            @foreach ($stores as $store)                                            
                                            <a class="dropdown-item" data-id="{{ $store->id}}" data-name="{{ $store->name}}"><i class="fas fa-store-alt"></i> {{$store->name}}</a>
                                            @endforeach
                                      </div>
                                      <input type="hidden" name="store_filter" class="ls-store-filter" id="store_filter_id" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Item</label>
                                        <div class="input-group flex-nowrap">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                                            </div>
                                            <v-select @search="fetchItems" :options="item_info" @input="fetch_product_info" v-model="selected_item"/>
                                            @error('items')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Select Date Range</label>
                                                <input type="text" name="anatomy-range" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form style="min-height: 400px">
                                    <div class="row" v-if="is_show==true">
                                        <div class="col-12">
                                            <h6 class="mb-3 text-muted">Item Details</h6>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    Item Name: @{{ selected_item.item_info.name }}
                                                </div>
                                                <div class="col-md-3">
                                                    Item Code: @{{ selected_item.item_info.code }}
                                                </div>
                                                <div class="col-md-3">
                                                    Bar Code: <span v-for="(barcode, index) in selected_item.barcodes" :key="index">@{{ barcode.barcode }} /</span>
                                                </div>
                                                <div class="col-md-3 mt-2">
                                                    Evaluation: @{{ selected_item.item_info.evaluation }} 
                                                </div>
                                                <div class="col-md-3 mt-2">
                                                    Generic Description: @{{ selected_item.item_info.generic_description }}
                                                </div>
                                                <div class="col-md-4 mt-2">
                                                    Short Description: @{{ selected_item.item_info.short_description }}
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    Long Description: @{{ selected_item.item_info.long_description }} 
                                                </div>
                                                <div class="col-md-3 mt-2">
                                                    Delivery Mode: @{{ selected_item.item_info.delivery_mode }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-1">
                                                <h6 class="mb-3 text-muted">Category</h6>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        Department: @{{ selected_item.item_info.department.name }}
                                                    </div>
                                                    <div class="col-md-3">
                                                        Category: @{{ selected_item.item_info.category.name }}
                                                    </div>
                                                    <div class="col-md-3">
                                                        Unit: @{{ selected_item.item_info.unit.name }}
                                                    </div>
                                                    <div class="col-md-2">
                                                        Quantity: @{{ selected_item.item_info.quantity }}
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="col-12 mt-1">
                                            <h6 class="mb-3 text-muted">Costing & Pricing</h6>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    Final Cost: @{{ selected_item.item_info.updated_price.cost }}
                                                </div>
                                                <div class="col-md-2">
                                                    Average Cost: @{{ selected_item.item_info.prices.avg_cost }}
                                                </div>
                                                <div class="col-md-3">
                                                    Last GRN Cost: @{{ selected_item.item_info.prices.last_grn_cost }}
                                                </div>
                                                <div class="col-md-2">
                                                    Markup: @{{ selected_item.item_info.updated_price.markup }} %
                                                </div>
                                                <div class="col-md-2">
                                                    Final Price: @{{ selected_item.item_info.updated_price.price }}
                                                </div>

                                                <div class="col-md-7" v-for="vendor in selected_item.vendors">
                                                    @{{ vendor.vendor.code }}-@{{ vendor.vendor.name }}: @{{ vendor.vendor_price }} AED
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-1">
                                                <h6 class="mb-3 text-muted">Transaction</h6>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        Opening Stock: @{{ selected_item.stocks.opening_stock }}
                                                    </div>
                                                    <div class="col-md-2">
                                                        Adjustment: @{{ selected_item.transaction.adjustment }}
                                                    </div>
                                                    <div class="col-md-2">
                                                        Damage: @{{ selected_item.transaction.damage }}
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="col-12 mt-1">
                                                <h6 class="mb-3 text-muted">Purchase</h6>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        Purchase: @{{ selected_item.purchase.purchase }}
                                                    </div>
                                                    <div class="col-md-2">
                                                        Sold:  @{{ selected_item.purchase.sold }}
                                                    </div>
                                                    <div class="col-md-2">
                                                        Transfer: @{{ selected_item.purchase.transfer }}
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-12 mt-1">
                                                <h6 class="mb-3 text-muted">Stock</h6>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        Current Stock: @{{ selected_item.stocks.current_stock }}
                                                    </div>
                                                    <div class="col-md-2">
                                                        SVC: @{{ selected_item.stocks.svc }}
                                                    </div>
                                                    <div class="col-md-2">
                                                        SVP:@{{ selected_item.stocks.svp }}
                                                    </div>
                                                </div>
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

Vue.component('v-select', VueSelect.VueSelect);

const app = new Vue({
    el: '#item-anatomy',
    data: {
        item_info: [],
        selected_item: {
        },
        selected_location: {
            id: '',
            name: ''
        },
        selected_loc:0,
        is_show: false,

    },
    methods:{
        
        fetchItems: function(search, loading){
            let ref = this;
            // console.log(search);
            axios.post('/api/item/list/for/track',{'search':search}).then(function(resposne){
                let data = resposne.data;
                console.log(data);
                if(data.status == 1){
                    let product_id = data.product_info.barcode;

                let sel_loc = document.getElementById('store_filter_id').value;
                if(sel_loc == 0){
                    alert("Select Location First");
                    return ;
                }
                    ref.selected_items = {};
                    axios.post('/api/anatomy/item/info', {'id':product_id, 'store_id': sel_loc}).then(function(resposne){
                        ref.is_show = true;
                        ref.selected_item = resposne.data;

                    });
                }else{
                    ref.item_info = resposne.data.results;
                }
            });
        },

        fetchInitItems: function(){
            let ref = this;
            axios.get('/api/item/list/init').then(function(resposne){
                ref.item_info = resposne.data.results;
            });
        },

        fetch_product_info: function(value){
            let ref = this;

            let product_id = value.code;
            console.log(product_id);
            ref.selected_items = {};
            let sel_loc = document.getElementById('store_filter_id').value;
            if(sel_loc == 0){
                alert("Select Location First");
                return ;
            }
            axios.post('/api/anatomy/item/info', {'id':product_id, 'store_id': sel_loc}).then(function(resposne){
                ref.is_show = true;
                ref.selected_item = resposne.data;

            });
        },

        generatePdf: function(){
            alert('Will generate Pdf later');
        }
    },
    created: function(){
        this.fetchInitItems();

    },
});

    $('.store-filter a').on('click', function(){
        store_id=$(this).data('id');
        if(store_id == 0){
            return;
        }
        store_name = $(this).data('name');
        $('#loc-text').text('');
        $('#loc-text').text(store_name);
        $('.ls-store-filter').val(store_id);
        table.draw();
    });

</script>
@endpush
