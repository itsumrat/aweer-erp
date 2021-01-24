@extends("layouts.app")

@section("title", "Aweer Inventory - Items")


@section("main_content")

        <main class="page-content" id="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Add Item</h5>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{ route('items.create') }}" role="tab" aria-controls="pills-standard" aria-selected="true">Standard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active"  href="{{ route('combo.create') }}" role="tab" aria-controls="pills-combo" aria-selected="false">Combo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"  href="{{ route('repacking.create') }}" role="tab" aria-controls="pills-repacking" aria-selected="false">Repacking</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <form action="{{ route('combo.store') }}" method="POST">
                                                            @csrf
                                    <div class="tab-pane fade show active" id="pills-standard" role="tabpanel" aria-labelledby="pills-standard-tab">
                                        @if(session('success'))
                                                <h1 class="text-success">{{session('success')}}</h1>
                                            @endif
                                            @if(session('error'))
                                                 <h1 class="text-danger">{{session('error')}}</h1>
                                            @endif
                                     
                                            <div class="row">
                                                <div class="col-12">
                                                    <div style="padding: 1rem;background-color: #f1f1f1;">
                                                        <h6 class="mb-2 text-muted">Item Details</h6>

                                                           
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Item Code*</label>
                                                                    <input type="text" class="form-control" name="code" v-model="item_code" v-on:keyup="fetch_product_info">
                                                                    @error('code')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <input type="hidden" name="product_id" v-model="selected_items.id" />
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlInput1">Item Name*</label>
                                                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="name" v-model="selected_items.name" readonly required>
                                                                @error('name')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Barcode*</label>
                                                                    <input type="text" class="form-control" name="barcode" required>
                                                                    
                                                                </div>
                                                            </div>
                                                            

                                                            
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Item Unit*</label>
                                                                    <select class="form-control" name="unit_id" v-on:change="generateItemPrice" v-model="selected_unit">
                                                                        <option value="">--Select--</option>
                                                                        <option v-for="unit in units" :key="unit.id" :value="unit.id">@{{ unit.name }}</option>
                                                                    </select>
                                                                    @error('unit_id')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                               
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div style="padding: 1rem;background-color: #f1f1f1;">
                                                        <h6 class="mb-2 text-muted">Price</h6>
                                                        <div class="row">
                                                           <div class="col-md-3">
                                                               <label>Item Price</label>
                                                               <input type="number" class="form-control"  name="combo_price" v-model="combo_price" step="any">
                                                               @error('combo_price')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                           </div>
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
        categories:{},
        departments:{},
        units:{},
        selected_unit:null, 
        vendors:{},
        item_info: [],
        selected_items: {},
        selected_item_info:[
        ],
        selected_vendor:'',
        vendor_payment_terms:'',
        combo_price: '',
        barcode: '',
        item_code:''

    },
    methods:{

        fetch_unit: function(){
            var ref = this;
            ref.units = null;
            let url = '/api/unit/list';
            axios.get(url).then(function(resposne){
                ref.units = resposne.data; 
            });


        },


        fetch_product_info: function(){
            let ref = this;
            let product_id = ref.item_code;
            console.log(product_id);
            ref.selected_items = {};
            axios.post('/api/product/info/by/code', {'id':product_id}).then(function(resposne){
                ref.selected_items = resposne.data;
                
            });

        },
        generateItemPrice: function(){
            let ref = this;
            let total_price = 0;
            let quantity = 0;
            let unit = {};

            unit = ref.units.filter(function(unit){
                return unit.id == ref.selected_unit;
            });
            
            if(unit[0].note != ''){
                quantity = parseInt(unit[0].note);
                if (isNaN(quantity)) {
                    quantity = 1;
                }
            }
            console.log(quantity);
            total_price += ref.selected_items.prices.final_price * quantity;
            ref.combo_price = total_price;
           
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
        }  
    },
    created: function(){
        this.fetch_unit();

    },
});

</script>
@endpush
