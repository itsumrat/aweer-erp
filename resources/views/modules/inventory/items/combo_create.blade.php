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
                                <a class="nav-link " href="{{ route('items.create') }}" role="tab" aria-controls="pills-standard" aria-selected="true">Item Master</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active"  href="{{ route('combo.create') }}" role="tab" aria-controls="pills-combo" aria-selected="false">Attach Barcode</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="{{ route('repacking.create') }}" role="tab" aria-controls="pills-repacking" aria-selected="false">Costing & Pricing</a>
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
                                            <h6 class="mb-2 text-muted">Attach Barcode</h6>
                                            <div class="row">
                                                <div class="col-7" >
                                                    <label>Vendor*</label>
                                                    <input type="hidden" name="vendor_id" v-model="selected_vendor.id">
                                                    <div class="form-group">
                                                        <v-select @search="fetch_vendor_list" :options="vendor_list" @input="fetch_vendor_info" >

                                                        </v-select>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-group input-group-sm col-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Discount Term</span>
                                                            </div>
                                                            <input type="text" class="form-control" v-model="selected_vendor.discount" readonly="">
                
                                                        </div>
                                                        <div class="input-group input-group-sm col-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Payment Term</span>
                                                            </div>
                                                            <input type="text" class="form-control" :value="showvendor" readonly="">
                                                        </div>
                                                        <div class="input-group input-group-sm col-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Vendor Type</span>
                                                            </div>
                                                            <input type="text" class="form-control" v-model="selected_vendor.type" readonly="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br><br>
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
                                                        <input type="text" class="form-control" name="barcode" >
                                                        @error('barcode')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Item Unit*</label>
                                                        <select class="form-control" name="unit_id">
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
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-draft mt-3">draft</button>
                                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                                    </div>
                                </div>
                            </form>
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
        props: ['showvendor'],
        data: {
        	units:{},
            item_info: [],
            selected_items: {},
            selected_item_info:[
            ],
            barcode: '',
            item_code:'',
            selected_vendor: {},
            vendor_list: [
    
            ],
    
    
    
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

            fetch_vendor_list: function(search, loading){
                let ref = this;
    
                if(search != ''){
                axios.post("{{url('/api/vendor/list')}}",{'search':search}).then(function(response){
                    ref.vendor_list = response.data.results;
                });
                }
            },
            
            fetch_vendor_info: function(value){
                let ref = this;
                console.log(value);
                let store_id = value;
                axios.post("{{url('/api/vendor/info')}}", {'id':store_id}).then(function(response){
    
                    ref.selected_vendor.id = response.data[0].id;
                    ref.selected_vendor.name = response.data[0].name;
                    ref.selected_vendor.discount = response.data[0].discount;
                    ref.selected_vendor.payment_term = response.data[0].payment_term;
                    ref.selected_vendor.type = response.data[0].type;
                    ref.showvendor = response.data[0].payment_term;
                    
                });
            },
            getInputName: function(index, dataName){
              //
            }
        },
        created: function(){
            this.fetch_unit();
    
        },
    });
</script>
@endpush
