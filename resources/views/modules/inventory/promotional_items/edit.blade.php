@extends("layouts.app")

@section("title", "Aweer Inventory - Promotion Product")


@section("main_content")

        <main class="page-content" id="promotional_product">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Add promotion item</h5>
                                <div class="title-icons">
                                    <a href="{{ route('item.promotion.index') }}"><i class="fas fa-history"></i></a>
                                </div>
                            </div>
                                                      @if(session('success'))
                                                <h1 class="text-success">{{session('success')}}</h1>
                                            @endif
                                            @if(session('error'))
                                                 <h1 class="text-danger">{{session('error')}}</h1>
                                            @endif
                            <div class="card-body">
                                <form method="POST" action="{{ route('item.promotion.update', $promotional_product->id) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input id="datetimepicker" type="text" class="form-control" name="date" value="{{ $promotional_product->date }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Reference</label>
                                                <input type="text" class="form-control" name="reference" v-model="reference" v-on:click="autoGenerateRef" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Promotion Date</label>
                                                <input type="text" name="promotion_date" class="form-control" value="{{ $promotional_product->promotion_start.'-'.$promotional_product->promotion_end }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="hidden" v-model="selected_location" name="location">
                                            <div class="form-group">
                                                <label>Location</label>
                                                <v-select multiple :options="location_list" @input="fetch_location_info" @focusout="clearLocation" v-model="edit_selected_location">
                                                     
                                                </v-select>
                                                {{-- <input type="hidden" name="location" v:model="selected_location.id"> --}}
                                                @error('location')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Item</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                                                    </div>
                                                    <v-select @search="fetchItems" :options="item_info" @input="fetch_product_info" v-model="edit_selected_item"/>
                                                                    @error('items')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Cost</label>
                                                        <input type="number" class="form-control" value="50" readonly="" v-model="selected_item.cost">
                                                        <input type="hidden" name="product_id" v-model="selected_item.id">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label>Price</label>
                                                        <input type="number" class="form-control" value="50" readonly="" v-model="selected_item.price">
                                                        <input type="hidden" name="product_id" v-model="selected_item.id">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Promotion Price</label>
                                                        <input type="number" class="form-control" name="promotional_price" value="{{ $promotional_product->promotion_price }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Note</label>
                                                <textarea class="form-control" rows="3" name="note">{{ $promotional_product->note }}</textarea>
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
<script>
Vue.component('v-select', VueSelect.VueSelect);

const app = new Vue({
    el: '#promotional_product',
    data: {
        item_info: [],
        selected_item: {
        	id: '{{ $promotional_product->id }}',
            cost: '{{ $product_pricing->final_cost }}',
            price: '{{ $product_pricing->final_price }}',
            promotion_price:'{{ $promotional_product->promotion_price }}'
        },
        selected_item_info:[
        ],
        new_price: '',
        reference: '{{ $promotional_product->reference }}',
        location_list: [],
        selected_location: [],
        edit_selected_item: {
            code: '',
            label : ''
        },
        edit_selected_location: []

    },
    methods:{
        
        fetchItems: function(search, loading){
            let ref = this;
            console.log(search);
            axios.post('/api/item/list',{'search':search}).then(function(resposne){
                let data = resposne.data;
                console.log(data);
                if(data.status == 1){
                ref.selected_item.id = data.product_info.id;
                ref.selected_item.price = data.product_info.prices.final_price;


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
            ref.selected_items = {};
            axios.post('/api/item/info', {'id':product_id}).then(function(resposne){
                ref.selected_item.id = resposne.data.id;
                ref.selected_item.cost = resposne.data.prices.final_cost;
                ref.selected_item.price = resposne.data.prices.final_price;

            });

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
        clearLocation: function(value){

        },

        generateItemPrice: function(){
            let ref = this;
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
                ref.reference = 'pr_' + Date.now();
            }

        },

        initEditItem: function(){
            let ref = this;
            let id = ref.selected_item.id;
            console.log(id);
            axios.post('/api/selected_item/for/selectbox', {'id':id}).then(function(resposne){
                let data = resposne.data;
                ref.edit_selected_item = data.results;
                console.log(ref.edit_selected_item);
            });         
        },
        initEditLocation: function(){
            let ref = this;

            let ids = '{{ $promotional_product->store_ids }}';
            ids = ids.split(',');
            ref.selected_location = [];
            for (var i = 0; i < ids.length; i++) {
                let location_id = ids[i];
                ref.selected_location.push(location_id);

            axios.post('/api/selected_location/for/selectbox', {'id':location_id}).then(function(resposne){
                let data = resposne.data;
                ref.edit_selected_location.push(data.results);

                console.log(ref.edit_selected_location);
            }); 
            }
            // axios.post('/api/selected_location/for/selectbox', {'id':location_id}).then(function(resposne){
            //     let data = resposne.data;
            //     ref.edit_selected_location = data.results;

            //     console.log(ref.edit_selected_location);
            // });   

        }

    },
    created: function(){
        this.fetchInitItems();
        this.fetchLocation();
        // this.autoGenerateRef();
        this.initEditItem();
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

// end jquery

</script>
@endpush
