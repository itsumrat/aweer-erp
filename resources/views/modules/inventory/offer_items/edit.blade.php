@extends("layouts.app")

@section("title", "Aweer Inventory - Offer Create")


@section("main_content")

        <main class="page-content" id="offer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Edit Offer</h5>
                                <div class="title-icons">
                                    <a href="{{ route('offer.index') }}"><i class="fas fa-history"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('offer.update', $offer_info->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input id="datetimepicker" type="text" class="form-control" name="date" autocomplete="off" value="{{ $offer_info->date }}">
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
                                                <input type="text" class="form-control" name="code" value="{{ $offer_info->code }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Barcode</label>
                                                <input type="text" class="form-control" name="barcode" value="{{ $offer_info->barcode }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Item Name</label>
                                                <input type="text" class="form-control" name="name" value="{{ $offer_info->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Unit</label>
                                                <select class="custom-select" id="inputGroupSelect04" name="unit" v-model="selected_unit_id">
                                                    <option selected value="">--Select--</option>
                                                    <option v-for="unit in units" :key="unit.id" :value="unit.id">@{{ unit.name }}</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="text" class="form-control" name="price" value="{{ $offer_info->price }}">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="hidden" name="location" v-model="selected_location">
                                            <div class="form-group">
                                                <label>Location</label>
                                                <v-select multiple :options="location_list" @input="fetch_location_info"  v-model="edit_selected_location" @remove="removeLocation"/>
                                                
                                                
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Product to buy</label>
                                                
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                                                    </div>
                                                    <v-select @search="fetchItems" :options="item_info" @input="fetch_buy_product_info" v-model="edit_selected_buy_item" />
                                                                    @error('items')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                </div>                                            </div>
                                            <input type="hidden" name="product_to_buy" v-model="selected_item_buy.id">
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input type="number" class="form-control" name="buy_quantity" value="{{ $offer_info->buy_quantity }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>product to get</label>
                                                
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                                                    </div>
                                                    <v-select @search="fetchItems" :options="item_info" @input="fetch_get_product_info" v-model="edit_selected_get_item"/>
                                                                    @error('items')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                </div>
                                            </div>
                                            <input type="hidden" name="product_to_get" v-model="selected_item_get.id">
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input type="number" class="form-control" name="get_quantity" value="{{ $offer_info->get_quantity }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>note</label>
                                                <textarea class="form-control" rows="3" name="note">{{ $offer_info->note }}</textarea>
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
        selected_unit_id : '{{ $offer_info->unit_id }}',
        location_list: [],
        selected_location: [],
        selected_item_buy: {
            id: '{{ $offer_info->buy_product_id }}',
            cost:'',
            price: '',
            markup: '',
        },
        selected_item_get: {
            id: '{{ $offer_info->get_product_id }}',
            cost:'',
            price: '',
            markup: '',
        },
        selected_item_info:[
        ],
        new_price: '',
        reference: '{{ $offer_info->reference }}',
        edit_selected_buy_item: {
            code: '',
            label : ''
        },
        edit_selected_get_item: {
            code: '',
            label : ''
        },
        edit_selected_location: []


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
                // if (!ref.selected_location.includes(value[i].code)) {
                    ref.selected_location.push(value[i].code);
                // }
            }
            console.log(ref.selected_location);
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
        removeLocation: function(){
            alert("working");
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

        },
        initEditBuyItem: function(){
            let ref = this;
            let id = ref.selected_item_buy.id;
            console.log(id);
            axios.post('/api/selected_item/for/selectbox', {'id':id}).then(function(resposne){
                let data = resposne.data;
                ref.edit_selected_buy_item = data.results;
            });         
        }, 
        initEditGetItem: function(){
            let ref = this;
            let id = ref.selected_item_get.id;
            console.log(id);
            axios.post('/api/selected_item/for/selectbox', {'id':id}).then(function(resposne){
                let data = resposne.data;
                ref.edit_selected_get_item = data.results;
            });         
        }, 
        initEditLocation: function(){
            let ref = this;

            let ids = '{{ $offer_info->store_ids }}';
            ids = ids.split(',');
            ref.selected_location = [];
            for (var i = 0; i < ids.length; i++) {
                let location_id = ids[i];
                ref.selected_location.push(location_id);
            axios.post('/api/selected_location/for/selectbox', {'id':location_id}).then(function(resposne){
                let data = resposne.data;
                ref.edit_selected_location.push(data.results);
            }); 
            }
            // axios.post('/api/selected_location/for/selectbox', {'id':location_id}).then(function(resposne){
            //     let data = resposne.data;
            //     ref.edit_selected_location = data.results;

            //     console.log(ref.edit_selected_location);
            // });   

        },

    },
    created: function(){
        this.fetchInitItems();
        this.fetchLocation();
        this.fetch_unit();
        // this.autoGenerateRef();
        this.initEditBuyItem();
        this.initEditGetItem();
        this.initEditLocation();

    },
});



// jquery

$('#datetimepicker').datetimepicker();
 var myDate = new Date();
  var date = myDate.getFullYear() + '-' + ('0'+ myDate.getMonth()+1).slice(-2) + '-' + ('0'+ myDate.getDate()).slice(-2);
  var date = myDate.getFullYear() + '/' + myDate.getMonth() + '/' + myDate.getDate();
  var time = myDate.getHours() + ":" + myDate.getMinutes();
  date = date +' '+time;

  // $("#datetimepicker").val(date);


  
$('input[name="promotion_date"]').daterangepicker();


</script>
@endpush
