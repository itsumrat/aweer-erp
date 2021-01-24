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
                                <form method="POST" action="{{ route('item.price.update.history.update', $price_update_data->id) }}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input id="datetimepicker" type="text" class="form-control" name="date" autocomplete="off" value="{{ $price_update_data->date }}">
                                                @error('date')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Reference</label>
                                                <input type="text" class="form-control" name="reference" v-model="reference" v-on:click="autoGenerateRef" readonly value="{{ $price_update_data->reference }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label>Location</label>
                                                <v-select :options="location_list" v-model="edit_selected_location" @input="fetch_location_info" />
                                                
                                                
                                            </div>
                                            <input type="hidden" name="location" :value="selected_location.id">
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
                                                    <v-select @search="fetchItems" v-model="edit_selected_item" :options="item_info" @input="fetch_product_info" />
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
                                            <textarea class="form-control" rows="3" placeholder="Note" name="note">{{ $price_update_data->note }}</textarea>
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
            id:'{{ $price_update_data->item_id }}',
            cost:'{{ $price_update_data->prev_cost }}',
            price: '{{ $price_update_data->prev_price }}',
            markup: '{{ $price_update_data->prev_markup }}',
            new_markup: '{{ $price_update_data->updated_markup }}',
            new_price: '{{ $price_update_data->updated_price }}'
        },
        selected_item_info:[
        ],
        new_price: '',
        tax: '{{ $tax }}',
        reference: '',
        location_list: [],
        selected_location: {
            id: '{{ $price_update_data->store_id }}',
            name: ''
        },
        edit_selected_item: {
        	code: '',
        	label : ''
        },
        edit_selected_location: {
        	code: '',
        	label : ''
        }

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
                ref.selected_item.markup = resposne.data.prices.markup + ' %';
                ref.selected_item.price = resposne.data.prices.final_price;
                console.log(ref.selected_item);
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
            let store_id = value;
            axios.post('/api/location/info', {'id':store_id}).then(function(resposne){

                ref.selected_location.id = resposne.data[0].id;
                ref.selected_location.name = resposne.data[0].name;
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
            total_price = parseFloat(ref.selected_item.cost) + ((parseFloat(ref.selected_item.cost) * parseFloat(ref.selected_item.new_markup))/100);
            total_price = total_price+((total_price * parseFloat(ref.tax))/100);
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
            if (ref.reference == '') {
            ref.reference =  'pr_'+Date.now();
            }

        },
        initEditItem: function(){
        	let ref = this;
        	let id = ref.selected_item.id;
        
            axios.post('/api/selected_item/for/selectbox', {'id':id}).then(function(resposne){
            	let data = resposne.data;
                ref.edit_selected_item = data.results;
            });        	
        },
        initEditLocation: function(){
			let ref = this;

			let location_id = ref.selected_location.id;
            axios.post('/api/selected_location/for/selectbox', {'id':location_id}).then(function(resposne){
            	let data = resposne.data;
                ref.edit_selected_location = data.results;

                console.log(ref.edit_selected_location);
            });   

        }
    },
    created: function(){
        this.fetchInitItems();
        this.fetchLocation();
        this.autoGenerateRef();
        this.initEditItem();
        this.initEditLocation();

    },
});


$('#datetimepicker').datetimepicker();
 var myDate = new Date();
  var date = myDate.getFullYear() + '-' + ('0'+ myDate.getMonth()+1).slice(-2) + '-' + ('0'+ myDate.getDate()).slice(-2);
  var date = myDate.getFullYear() + '/' + myDate.getMonth() + '/' + myDate.getDate();
  var time = myDate.getHours() + ":" + myDate.getMinutes();
  date = date +' '+time;

  // $("#datetimepicker").val(date);
</script>
@endpush
