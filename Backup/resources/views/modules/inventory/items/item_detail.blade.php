@extends("layouts.app")

@section("title", "Aweer Inventory - Item Detail")


@section("main_content")

        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Track Barcode</h5>
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
                                <form>
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
                                    <table id="item-desc" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Date</th>
                                                <th>Item Name(Code)</th>
                                                <th>Reference</th>
                                                <th>Location</th>
                                                <th>Transaction Type</th>
                                                <th>Transaction Details</th>
                                                <th>Quantity(PCS/KG)</th>
                                                <th>Final Quantity</th>
                                                <th>Staff Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>101052</td>
                                                <td>System Architect</td>
                                                <td>asdfasdfa</td>
                                                <td>Arafat Mohammed Akter Fruits & Vegetables</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                                <td>asdasfaedr</td>
                                                <td>asdfas</td>
                                                <td>asdfas</td>
                                            </tr>
                                            <tr>
                                                <td>101052</td>
                                                <td>System Architect</td>
                                                <td>Arafat Mohammed Akter Fruits & Vegetables</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                                <td>asdasfaedr</td>
                                                <td>asdfas</td>
                                                <td>asdfas</td>
                                                <td>asdfas</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
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
    el: '#page-content',
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
        // generateItemPrice: function(field = ''){
        //     let ref = this;
        //     if (field == 'markup') {
        //         if (isNaN(ref.selected_item.new_markup )) {
        //             ref.selected_item.new_markup = '';
        //             return;
        //         }
        //     }
        //     let total_price = 0;
        //     total_price = parseFloat(ref.selected_item.cost) + ((parseFloat(ref.selected_item.cost) * parseFloat(ref.selected_item.new_markup))/100);
            
        //     total_price += (parseFloat(total_price) * parseFloat(ref.tax))/100;
        //     ref.selected_item.new_price = total_price;
           
        // },
        // removeItem: function(id){
        //     let ref = this;
        //     ref.selected_item_info = ref.selected_item_info.filter(function(item){
        //         return item.id != id; 
        //     });

        //     this.generateItemPrice();
        // },
        // getInputName: function(index, dataName){
        //   return "items["+index+"]["+dataName+"]";
        // },
        // autoGenerateRef: function(){
        //     let ref = this;
        //     axios.post("{{ url('/api/reference/generate')}}", {'table':'price_update_histories', 'refcode':'PUP'}).then(function(response){
        //         ref.reference = response.data.reference;
        //     });


        // } 
    },
    created: function(){
        this.fetchInitItems();
        this.fetchLocation();
        this.autoGenerateRef();

    },
});


</script>


@endpush
