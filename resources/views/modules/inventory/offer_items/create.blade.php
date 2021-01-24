@extends("layouts.app")

@section("title", "Aweer Inventory - Offer Create")


@section("main_content")

        <main class="page-content" id="offer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Add Offer</h5>
                                <div class="title-icons">
                                    <a href="{{ route('offer.index') }}"><i class="fas fa-history"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('offer.store') }}">
                                	@csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input id="datetimepicker" type="text" class="form-control" name="date" autocomplete="off" value="{{ date('Y/m/d h:m:s') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Reference</label>
                                                <input type="text" v-on:click="autoGenerateRef" class="form-control" v-model="reference" name="reference" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Item Code</label>
                                                <input type="text" class="form-control" name="code">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Barcode</label>
                                                <input type="text" class="form-control" name="barcode">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Item Name</label>
                                                <input type="text" class="form-control" name="name">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Unit</label>
                                                <select class="custom-select" id="inputGroupSelect04" name="unit">
                                                    <option selected value="">--Select--</option>
                                                    <option v-for="unit in units" :key="unit.id" :value="unit.id">@{{ unit.name }}</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="text" class="form-control" name="price">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label>Location</label>
                                                <v-select multiple :options="location_list" @input="fetch_location_info" />
                                                
                                                
                                            </div>
                                            <input type="hidden" name="location" v-model="selected_location">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Product to buy</label>
                                                
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                                                    </div>
                                                    <v-select @search="fetchItems" :options="item_info" @input="fetch_buy_product_info" />
                                                                    @error('items')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                </div>                                            </div>
                                            <input type="hidden" name="product_to_buy" v-model="selected_item_buy.id">
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input type="number" class="form-control" name="buy_quantity">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>product to get</label>
                                                
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                                                    </div>
                                                    <v-select @search="fetchItems" :options="item_info" @input="fetch_get_product_info" />
                                                                    @error('items')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                </div>
                                            </div>
                                            <input type="hidden" name="product_to_get" v-model="selected_item_get">
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input type="number" class="form-control" name="get_quantity">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>note</label>
                                                <textarea class="form-control" rows="3" name="note"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-draft mt-3">draft</button>
                                        <button type="submit" class="btn btn-primary mt-3">Save</button>
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
<script type="text/javascript">
Vue.component('v-select', VueSelect.VueSelect);

const app = new Vue({
    el: '#offer',
    data: {
        item_info: [],
        units: [],
        location_list: [],
        selected_location: [],
        selected_item_buy: {
        	id: '',
            cost:'',
            price: '',
            markup: '',
        },
        selected_item_get: '',
        selected_item_info:[
        ],
        new_price: '',
        reference: '',


    },
    methods:{
        
        fetchItems: function(search, loading){
            let ref = this;

            if(search != ''){
            axios.post('/api/item/list',{'search':search}).then(function(resposne){
                ref.item_info = resposne.data.results;
            });
            }

        },

        fetchLocation: function(){
			let ref = this;
            axios.get('/api/location/list/init').then(function(resposne){
                ref.location_list = resposne.data.results;
            });
        },
        fetch_location_info: function(value){
        	let ref = this;
            ref.selected_location = [];

            for (var i = 0; i < value.length; i++) {
                ref.selected_location.push(value[i].code);
            }
        },

        fetchInitItems: function(){
            let ref = this;
            axios.get('/api/item/list/init').then(function(resposne){
                ref.item_info = resposne.data.results;
            });
        },
        fetch_unit: function(){
            var ref = this;
            ref.units = null;
            let url = '/api/unit/list';
            axios.get(url).then(function(resposne){
                
                ref.units = resposne.data; 
            });


        },

        fetch_buy_product_info: function(value){
            let ref = this;
            let product_id = value.code;
            ref.selected_item_buy = {};
            axios.post('/api/item/info', {'id':product_id}).then(function(resposne){
                ref.selected_item_buy.id = resposne.data.id;
                ref.selected_item_buy.cost = resposne.data.prices.final_cost;
                ref.selected_item_buy.markup = resposne.data.prices.markup + ' %';
                ref.selected_item_buy.price = resposne.data.prices.final_price;

                console.log(ref.selected_item_buy);
            });

        },

        fetch_get_product_info: function(value){
            let ref = this;
            let product_id = value.code;
            ref.selected_item_get = {};
            axios.post('/api/item/info', {'id':product_id}).then(function(resposne){
                ref.selected_item_get = resposne.data.id;
                // ref.selected_item_get.cost = resposne.data.prices.final_cost;
                // ref.selected_item_get.markup = resposne.data.prices.markup + ' %';
                // ref.selected_item_get.price = resposne.data.prices.final_price;
                // console.log(ref.selected_item_get);
            });

        },
        generateItemPrice: function(field = ''){
            let ref = this;
            if (field == 'markup') {
                if (isNaN(ref.selected_item.new_markup )) {
                    ref.selected_item.new_markup = '';
                    return;
                }
            }

            let total_price = 0;
            total_price = ref.selected_item.cost + ((ref.selected_item.cost * ref.selected_item.new_markup)/100);
            ref.selected_item.new_price = total_price;
           
        },
        removeItem: function(id){
            let ref = this;
            ref.selected_item_info = ref.selected_item_info.filter(function(item){
                return item.id != id; 
            });

            this.generateItemPrice();
        },
        getInputName: function(index, dataName){
          return "items["+index+"]["+dataName+"]";
        },
        autoGenerateRef: function(){
            let ref = this;
            if(ref.reference == ''){
                ref.reference =  'io_' + Date.now();
            }

        } 
    },
    created: function(){
        this.fetchInitItems();
        this.fetchLocation();
        this.fetch_unit();
        this.autoGenerateRef();

    },
});



// jquery

$('#datetimepicker').datetimepicker();
  
$('input[name="promotion_date"]').daterangepicker();


</script>
@endpush
