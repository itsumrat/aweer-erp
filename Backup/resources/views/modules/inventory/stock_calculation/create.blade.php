@extends("layouts.app")

@section("title", "Aweer Inventory - Department")


@section("main_content")
           <main class="page-content" id="stock-calculation">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Stock Calculation</h5>
                            </div>
                            <div class="card-body">
                                        @if(session('success'))
                                                <h1 class="text-success">{{session('success')}}</h1>
                                            @endif
                                            @if(session('error'))
                                                 <h1 class="text-danger">{{session('error')}}</h1>
                                            @endif


                                <form action="{{ route('stock_calculation.store') }}" method="POST">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Zone</label>
                                                <input type="text" class="form-control" name="zone" value="{{ session('zone')!=''?session('zone'):'' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Location</label>
                                                <v-select  :options="location_list" @input="fetch_location_info" v-model="selected_location_for_box"/>
                                                
                                                
                                            </div>
                                            <input type="hidden" name="store_id" v-model="selected_location.id">
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <label>Item</label>
                                            <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                                                    </div>
                                                <v-select 
                                                    @search="fetchItems" 
                                                    :options="item_info" 
                                                    @input="fetch_product_info" v-model="sel_item"
                                                />
                                                    
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="hidden" name="product_id" v-model="selected_item_id">
                                                <label>Counted Stock</label>
                                                <input type="number" class="form-control" name="counted_stock">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" name="action" value="send" class="btn btn-primary btn-draft mt-4">Send</button>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" name="action" class="btn btn-primary mt-3" value="save">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
      <!-- page-content" -->
@endsection


@push("js_script")
<script>

Vue.component('v-select', VueSelect.VueSelect);

const app = new Vue({
    el: '#stock-calculation',
    data: {
        item_info: [],
        selected_item: {
        },
        sel_item:{code:'', label:''},
        selected_item_info:[
        ],
        new_price: '',
        reference: '',
        location_list: [],
        selected_location: {
            id: '{{ session('location_id') }}',
            name: '{{ session('location_name') }}',
        },
        selected_location_for_box:{
            code: '{{ session('location_id') }}',
            label: '{{ session('location_name') }}',
        },
        selected_item_id : '',

    },
    methods:{
        
        fetchItems: function(search, loading){
            let ref = this;
            console.log(search);
            axios.post('/api/item/list',{'search':search}).then(function(resposne){
                let data = resposne.data;
                console.log(data);
                if(data.status == 1){
                    ref.sel_item.value = data.product_info.barcode;
                    ref.sel_item.label = data.product_info.name;
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
                ref.selected_item_id = resposne.data.id;
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
            total_price = parseFloat(ref.selected_item.cost) + parseFloat(((parseFloat(ref.selected_item.cost) * parseFloat(ref.selected_item.new_markup))/100));
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
            axios.post('/api/reference/generate', {'table':'stock_calculations', 'refcode':'SCAL'}).then(function(response){
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


// jquery

$('#datetimepicker').datetimepicker();
$('input[name="promotion_date"]').daterangepicker();


</script>
@endpush
