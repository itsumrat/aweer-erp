@extends("layouts.app")

@section("title", "Aweer Inventory - Department")


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
                                <form method="POST" action="{{ route('item.promotion.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input id="datetimepicker" type="text" class="form-control" name="date">
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
                                                <input type="text" name="promotion_date" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="hidden" v-model="selected_location" name="location">
                                            <div class="form-group">
                                                <label>Location</label>
                                                <v-select multiple :options="location_list" @input="fetch_location_info" @focusout="clearLocation">
                                                      
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
                                                    <v-select @search="fetchItems" :options="item_info" @input="fetch_product_info" />
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
                                                        <input type="number" class="form-control" name="promotional_price" step="any">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Note</label>
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
<script>
Vue.component('v-select', VueSelect.VueSelect);

const app = new Vue({
    el: '#promotional_product',
    data: {
        item_info: [],
        selected_item: {
        	id: '',
            cost: '',
            price: '',
            promotion_price:''
        },
        selected_item_info:[
        ],
        new_price: '',
        reference: '',
        location_list: [],
        selected_location: [],


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

        } 
    },
    created: function(){
        this.fetchInitItems();
        this.fetchLocation();
        this.autoGenerateRef();

    },
});


// jquery

$('#datetimepicker').datetimepicker();
 var myDate = new Date();
  var date = myDate.getFullYear() + '-' + ('0'+ myDate.getMonth()+1).slice(-2) + '-' + ('0'+ myDate.getDate()).slice(-2);
  var date = myDate.getFullYear() + '/' + myDate.getMonth() + '/' + myDate.getDate();
  var time = myDate.getHours() + ":" + myDate.getMinutes();
  date = date +' '+time;

  $("#datetimepicker").val(date);

$('input[name="promotion_date"]').daterangepicker();

// end jquery

</script>
@endpush
