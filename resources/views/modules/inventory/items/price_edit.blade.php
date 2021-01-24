@extends("layouts.app")

@section("title", "Aweer Inventory - Price Update")


@section("main_content")
        <main class="page-content" id="price-update">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>price update</h5>
                            <div class="title-icons">
                                    <a href="{{ route('item.price.update.history') }}"><i class="fas fa-history"></i></a>
                                </div>
                            </div>
                            @if(session('success'))
                                                <h1 class="text-success">{{session('success')}}</h1>
                                            @endif
                                            @if(session('error'))
                                                 <h1 class="text-danger">{{session('error')}}</h1>
                                            @endif
                            <div class="card-body">
                                <form method="POST" action="{{ route('item.price.update') }}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input id="datetimepicker" type="text" class="form-control" name="date" autocomplete="off" value="{{ date('Y/m/d h:m:s') }}">
                                                @error('date')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Reference</label>
                                                <input type="text" class="form-control" name="reference" v-model="reference" v-on:click="autoGenerateRef" readonly value="{{ old('reference') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label>Location</label>
                                                <v-select multiple :options="location_list" @input="fetch_location_info" @focusout="clearLocation">
                                                
                                                
                                            </div>
                                            <input type="hidden" name="location" v-model="selected_location">
                                            @error('location')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                             <label>Select Item</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                                                    </div>
                                                    <v-select @search="fetchItems" :options="item_info" @input="fetch_product_info" />
                                                                    @error('items')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Cost</label>
                                                <input type="number" class="form-control" value="502" readonly="" v-model="selected_item.cost" name="prev_price">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="number" class="form-control" value="502" readonly="" v-model="selected_item.price" name="prev_price">
                                                <input type="hidden" v-model="selected_item.id" name="id">
                                                <input type="hidden" v-model="selected_item.cost" name="prev_cost">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Markup</label>
                                                <input type="text" class="form-control" readonly="" v-model="selected_item.markup" name="prev_markup">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                                                <label>New Markup</label>
                                                            <div class="input-group">
                                                                  
                                                                  <input type="text" class="form-control" v-model="selected_item.new_markup" v-on:keyup="generateItemPrice('markup')" name="new_markup">
                                                                  <div style="height: 34px" class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1">%</span>
                                                                  </div>
                                                                </div>
                                                                @error('markup')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>New Price</label>
                                                <input type="text" class="form-control" readonly="" v-model="selected_item.new_price" name="new_price">
                                                @error('new_price')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <textarea class="form-control" rows="3" placeholder="Note" name="note"></textarea>
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
    el: '#price-update',
    data: {
        item_info: [],
        selected_item: {
            cost:'',
            price: '',
            markup: '',
            new_markup: '',
            new_price: ''
        },
        selected_item_info:[
        ],
        new_price: '',
        reference: '',
        tax: '{{ $tax }}',
        location_list: [],
        selected_location: [],

    },
    methods:{
        
        fetchItems: function(search, loading){
            let ref = this;
            console.log(search);
            axios.post("{{ url('api/item/list')}}",{'search':search}).then(function(resposne){
                let data = resposne.data;
                console.log(data);
                if(data.status == 1){
                ref.selected_item.id = data.product_info.id;
                ref.selected_item.cost = data.product_info.prices.final_cost;
                ref.selected_item.markup = data.product_info.prices.markup + ' %';
                ref.selected_item.price = data.product_info.prices.final_price;
                }else{
                    ref.item_info = resposne.data.results;
                }
            });
        },

        fetchInitItems: function(){
            let ref = this;
            axios.get("{{ url('api/item/list/init')}}").then(function(resposne){
                ref.item_info = resposne.data.results;
            });
        },

        fetch_product_info: function(value){
            let ref = this;
            let product_id = value.code;
            ref.selected_items = {};
            let selected_loc = ref.selected_location;
            let location_id = '';
            if(selected_loc.length == 0){
                alert("Please Select Location First");
                return;
            }else{
            location_id = ref.selected_location[0];
            }
            
            axios.post("{{ url('api/item/info/with/all')}}", {'id':product_id, 'location_id':location_id}).then(function(resposne){
                ref.selected_item.id = resposne.data.id;
                ref.selected_item.cost = resposne.data.updated_price.cost;
                ref.selected_item.markup = resposne.data.updated_price.markup + ' %';
                ref.selected_item.price = resposne.data.updated_price.price;
                console.log(ref.selected_item);
            });

        },
        fetchLocation: function(){
            let ref = this;
            axios.get("{{ url('/api/location/list/init/with/all')}}").then(function(resposne){
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
        generateItemPrice: function(field = ''){
            let ref = this;
            if (field == 'markup') {
                if (isNaN(ref.selected_item.new_markup )) {
                    ref.selected_item.new_markup = '';
                    return;
                }
            }
            let total_price = 0;
            total_price = parseFloat(ref.selected_item.cost) + ((parseFloat(ref.selected_item.cost) * parseFloat(ref.selected_item.new_markup))/100);
            
            total_price += (parseFloat(total_price) * parseFloat(ref.tax))/100;
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
            axios.post("{{ url('/api/reference/generate')}}", {'table':'price_update_histories', 'refcode':'PUP'}).then(function(response){
                ref.reference = response.data.reference;
            });


        } 
    },
    created: function(){
        this.fetchInitItems();
        this.fetchLocation();
        this.autoGenerateRef();

    },
});


</script>
@endpush
