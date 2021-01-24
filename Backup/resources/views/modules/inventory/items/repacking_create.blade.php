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
                                        <a class="nav-link"  href="{{ route('combo.create') }}" role="tab" aria-controls="pills-combo" aria-selected="false">Combo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active"  href="{{ route('repacking.create') }}" role="tab" aria-controls="pills-repacking" aria-selected="false">Repacking</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <form action="{{ route('repacking.store') }}" method="POST">
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
                                                                    <label for="exampleFormControlInput1">Item Name*</label>
                                                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="name">
                                                                @error('name')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Item Code*</label>
                                                                    <input type="text" class="form-control" name="code">
                                                                    @error('code')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Barcode*</label>
                                                                    <input type="text" class="form-control" name="barcode">
                                                                    @error('barcode')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Evaluation</label>
                                                                    <select class="form-control" name="evalucation">
                                                                        <option>A</option>
                                                                        <option>B</option>
                                                                        <option>C</option>
                                                                    </select>
                                                                    @error('evalucation')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Generic Description</label>
                                                                    <input type="text" class="form-control" name="generic_description">
                                                                </div>
                                                                @error('generic_description')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Short Description</label>
                                                                    <input type="text" class="form-control" name="short_description">
                                                                    @error('short_description')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label>Long Description</label>
                                                                    <input type="text" class="form-control" name="long_description">
                                                                    @error('long_description')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Delivery mode</label>
                                                                    <select class="form-control" name="delivery_mode">
                                                                        <option>DC</option>
                                                                        <option>DSD</option>
                                                                    </select>
                                                                    @error('delivery_mode')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <div style="padding: 1rem;background-color: #f1f1f1;">
                                                        <h6 class="mb-2 text-muted">Category</h6>
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Department</label>
                                                                    <select class="form-control" name="department_id">
                                                                        <option value="">--Select--</option>
                                                                        <option v-for="dept in departments" :key="dept.id" :value="dept.id">@{{ dept.name }}</option>
                                                                    </select>
                                                                    @error('department_id')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Category </label>
                                                                    <select class="form-control" name="category_id">
                                                                        <option value="">--Select--</option>
                                                                        <option v-for="category in categories" :key="categories.id" :value="category.id">@{{ category.name }}</option>
                                                                    </select>
                                                                    @error('category_id')
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
                                                            
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Alert Quantity</label>
                                                                    <input type="number" class="form-control" name="alert_quantity">
                                                                    @error('alert_quantity')
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
                                                               <label>Additional Cost</label>
                                                               <input type="text" v-model="additional_cost" v-on:keyup="add_additional_cost" class="form-control" name="additional_cost">
                                                            </div>
                                                            <div class="col-md-3">
                                                               <label>Item Price</label>
                                                               <input type="number" class="form-control" v-model="item_price" readonly="" name="price">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-12 mt-1">
                                                    <div style="padding: 1rem;background-color: #f1f1f1;">
                                                        <h6 class="mb-2 text-muted">Price</h6>
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label>Item</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                                                    </div>
                                                    <v-select @search="fetchItems" :options="item_info" @input="fetch_product_info" />
                                                                
                                                </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <table id="adjustment-addition" class="table table-striped table-bordered" style="width:100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Barcode</th>
                                                                            <th>Item name</th>
                                                                            <th>Org. quantity</th>
                                                                            <th>Org. price</th>
                                                                            <th>New quantity</th>
                                                                            <th>New price</th>
                                                                            <th><a href="#"><i class="far fa-trash-alt"></i></a></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>@{{ selected_item.barcode }}</td>
                                                                            <td>@{{ selected_item.name }}</td>
                                                                            <td>
                                                                                <input type="number" class="form-control" v-model="selected_item.org_quantity">
                                                                                <input type="hidden" v-model="selected_item.id" name="product_id">
                                                                            </td>
                                                                            <td>
                                                                                <input type="number" class="form-control" v-model="selected_item.org_price" step="any">
                                                                            </td>
                                                                            <td>
                                                                                <input type="number" class="form-control" v-model="selected_item.new_quantity" v-on:keyup="generateItemPrice" name="quantity">
                                                                            </td>
                                                                            <td>
                                                                                <input type="number" class="form-control" v-model="selected_item.new_price"  v-on:keyup="generateItemPrice" name="unit_price" step="any">
                                                                            </td>
                                                                            <td>
                                                                                <a v-on:click="removeItem"><i class="far fa-window-close"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h5>Note</h5>
                                                                <textarea class="form-control" rows="3"></textarea>
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
        vendors:{},
        item_info: [],
        selected_item:{
            id:'',
            name:'',
            barcode: '',
            org_quantity:'',
            org_price: '',
            new_price: '',
            new_quantity: ''
        },
        selected_vendor:'',
        vendor_payment_terms:'',
        item_price: '',
        additional_cost: '',
        showTableItem: '',

    },
    methods:{
        fetch_category: function(){
            var ref = this;
            ref.categories = null;
            let url = '/api/category/list';
            axios.get(url).then(function(resposne){
                
                ref.categories = resposne.data; 
            });


        },
        fetch_department: function(){
            var ref = this;
            ref.departments = null;
            let url = '/api/department/list';
            axios.get(url).then(function(resposne){
                
                ref.departments = resposne.data; 
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

        fetch_vendor: function(){
            var ref = this;
            ref.vendors = null;
            let url = '/api/vendor/list';
            axios.get(url).then(function(resposne){
                
                ref.vendors = resposne.data; 
            });
        },
        selectedVendor: function(event){
            let ref = this;
            let sel_vendor_id = ref.selected_vendor;
            let sel_vendor = ref.vendors.filter(function(vendor){
                return vendor.id == sel_vendor_id
            });
           ref.vendor_payment_terms = sel_vendor[0].payment_term + ' days';

        },
        fetchItems: function(search, loading){
            let ref = this;
            console.log(search);
            axios.post('/api/item/list',{'search':search}).then(function(resposne){
                let data = resposne.data;
                console.log(data);
                if(data.status == 1){
                ref.selected_item.id = data.product_info.id;
                ref.selected_item.name = data.product_info.name;
                ref.selected_item.barcode = data.product_info.barcode;
                ref.selected_item.org_quantity = data.product_info.quantity;
                ref.selected_item.org_price = data.product_info.prices.final_price;
                ref.showTableItem = "1";


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
                ref.selected_item.name = resposne.data.name;
                ref.selected_item.barcode = resposne.data.barcode;
                ref.selected_item.org_quantity = resposne.data.quantity;
                ref.selected_item.org_price = resposne.data.prices.final_price;
                ref.showTableItem = "1";
                
            });

        },
        generateItemPrice: function(){
            let ref = this;
            
            ref.item_price = ref.selected_item.new_quantity * ref.selected_item.new_price;
           
        },
        removeItem: function(){
            let ref = this;
                ref.selected_item.id = '';
                ref.selected_item.name = '';
                ref.selected_item.barcode = '';
                ref.selected_item.org_quantity = '';
                ref.selected_item.org_price = '';
                ref.showTableItem = '';
            this.generateItemPrice();
        },
        getInputName: function(index, dataName){
          return "items["+index+"]["+dataName+"]";
        },
        add_additional_cost: function(){
            let ref = this;
            let total = ref.selected_item.new_price * ref.selected_item.new_quantity;
            total += (ref.additional_cost * total)/100;

            ref.item_price = total;
        }
    },
    created: function(){
        this.fetch_category();
        this.fetch_unit();
        this.fetch_department();
        this.fetch_vendor();
        this.fetchInitItems();

    },
});

</script>
@endpush
