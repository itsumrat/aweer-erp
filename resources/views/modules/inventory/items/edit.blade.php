@extends("layouts.app")

@section("title", "Aweer Inventory - Items")


@section("main_content")

        <main class="page-content" id="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Edit Item</h5>
                            </div>
                            <div class="card-body">
                            
                                <div class="tab-content" id="pills-tabContent">
                                    <form action="{{ route('items.update', $item_info->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
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
                                                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="name" value="{{ $item_info->productPricing->name }}">
                                                                @error('name')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Item Code*</label>
                                                                    <input type="text" class="form-control" name="code" value="{{ $item_info->productPricing->code }}">
                                                                    @error('code')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Barcode*</label>
                                                                    <input type="text" class="form-control" name="barcode"  value="{{ $item_info->barcode }}">
                                                                    @error('barcode')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Evaluation</label>
                                                                    <select class="form-control" name="evalucation">
                                                                        <option {{ ($item_info->productPricing->evaluation == 'something')?'selected':'' }}>something</option>
                                                                        <option {{ ($item_info->productPricing->evaluation == 'Ev 2')?'selected':'' }}>Ev 2</option>
                                                                        <option {{ ($item_info->productPricing->evaluation == 'Ev 3')?'selected':'' }}>Ev 3</option>
                                                                        <option {{ ($item_info->productPricing->evaluation == 'Ev 4')?'selected':'' }}>Ev 4</option>
                                                                    </select>
                                                                    @error('evalucation')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Generic Description</label>
                                                                    <input type="text" class="form-control" name="generic_description"  value="{{ $item_info->generic_description }}">
                                                                </div>
                                                                @error('generic_description')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Short Description</label>
                                                                    <input type="text" class="form-control" name="short_description"  value="{{ $item_info->short_description }}">
                                                                    @error('short_description')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label>Long Description</label>
                                                                    <input type="text" class="form-control" name="long_description"  value="{{ $item_info->long_description }}">
                                                                    @error('long_description')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Delivery mode</label>
                                                                    <select class="form-control" name="delivery_mode">
                                                                        <option {{ ($item_info->evaluation == 'DC')?'selected':'' }}>DC</option>
                                                                        <option {{ ($item_info->evaluation == 'DSD')?'selected':'' }}>DSD</option>
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
                                                                    <select class="form-control" name="department_id" v-model="selected.department">
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
                                                                    <select class="form-control" name="category_id" v-model="selected.category">
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
                                                                    <select class="form-control" name="unit_id" v-model="selected.unit">
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
                                                                    <label>Quantity</label>
                                                                    <input type="number" class="form-control" name="quantity" value="{{ $item_info->quantity }}">
                                                                    @error('quantity')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Alert Quantity</label>
                                                                    <input type="number" class="form-control" name="alert_quantity" value="{{ $item_info->alert_quantity }}">
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
                                                        <h6 class="mb-2 text-muted">Costing & Pricing</h6>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Final Cost</label>
                                                                    <input type="text" class="form-control" name="final_cost" v-model="final_cost" v-on:keyup="final_price_calculate">
                                                                    @error('final_cost')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Average Cost</label>
                                                                    <input type="text" class="form-control" name="avg_cost" value="{{ $item_info->productPricing->avg_cost }}">
                                                                    @error('avg_cost')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Last GRN Cost</label>
                                                                    <input type="text" class="form-control" name="last_grn_cost" value="{{ $item_info->productPricing->last_grn_cost }}">
                                                                    @error('last_grn_cost')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            {{-- <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Markup</label>
                                                                    <input type="text" class="form-control" name="markup">
                                                                    @error('markup')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div> --}}
                                                            <div class="col-md-3">
                                                                <label>Markup</label>
                                                            <div class="input-group">
                                                                  
                                                                  <input type="text" class="form-control" name="markup" v-on:keyup='markupTypeCheck(); final_price_calculate()' v-model="markup" aria-describedby="basic-addon1">
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
                                                                    <label>Final Price</label>
                                                                    <input readonly="readonly" type="text" class="form-control" name="final_price" v-model="final_price" >
                                                                    @error('final_price')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Price Without Tax</label>
                                                                    <input readonly="readonly" type="text" class="form-control" name="price_without_tax" v-model="price_without_tax" >
                                                                    @error('price_without_tax')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12 mt-1" >
                                                    <div style="padding: 1rem;background-color: #f1f1f1;">
                                                        <h6 class="mb-2 text-muted">Vendor <button class="btn btn-success btn-sm" type="button" v-on:click="vendorInc">+</button></h6>
                                                        <div v-for="(vendor, index) in vendor_list">
                                                            <h6>Vendor @{{ vendor.serial }}<button class="btn btn-sm" v-on:click="removeVendor(vendor.serial)">  <i class="fas fa-minus-circle"></i></button></h6>
                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <div clss="form-group">
                                                                    <select class=" form-control" @change="selectedVendor(vendor.serial)" v-model="vendor_list[index].id" v-bind:name="getInputName(index, 'id')">
                                                                       <option value="">--Select--</option>
                                                                      <option v-for="vendor in vendors" :key="vendor.id" :value="vendor.id">@{{ vendor.name }}</option>
                                                                
                                                                       
                                                                    </select>
                                                                    @error('vendor_id')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                                <br>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <input type="text" class="form-control" readonly="true" v-model="vendor_list[index].terms" placeholder="vendor terms">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input v-model="vendor_list[index].price" type="text" class="form-control" placeholder="Vendor price" v-bind:name="getInputName(index, 'price')">
                                                                            @error('vendor_price')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                        </div><br><br>
                                                                        <div class="col-md-4 form-group">
                                                                            
                                                                            <input class="form-control" type="text"  readonly="readonly" v-model="vendor_list[index].discount" placeholder="Discount">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label>Note</label>
                                                                <textarea class="form-control" rows="3" placeholder="Write a note"></textarea>
                                                                @error('note')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
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
const app = new Vue({
    el: '#page-content',
    data: {
    	categories:{},
    	departments:{},
    	units:{},
        vendors:{},
        selected_vendor:'',
        {{-- edit_selected_vendor_data: {{ json_encode($vendor_data) }}, --}}
        vendor_payment_terms:'',
        edit_product_id: {{ $item_info->id }},
        selected: {
            unit: {{ $item_info->unit_id }},
            department: {{ $item_info->department_id }},
            category: {{ $item_info->category_id }},
        },
        final_cost: {{ $item_info->productPricing->final_cost }},
        final_price: {{ $item_info->productPricing->final_price }},
        markup: {{ $item_info->productPricing->markup }},
        price_without_tax: '{{ $item_info->productPricing->price_without_tax }}',
        tax: '{{ $tax }}',
        vendor_list: [
            {
                serial: 1,
                id: '',
                price: '',
                terms: '',
                discount: ''
            }
        ],



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
            ref.vendors = {};
            let url = '/api/vendor/list';
            axios.get(url).then(function(resposne){
                
                ref.vendors = resposne.data;
            });
        },
        selectedVendor: function(serial){
            let ref = this;

            sel_vend = ref.vendor_list.filter(function(vendor){
                return vendor.serial == serial;
            });
            let selected_vendor_id = sel_vend[0].id;

            let selected_vendor_info = ref.vendors.filter(function(vend){
                return vend.id == selected_vendor_id;
            });

            ref.vendor_list.map(function(vend){
                if(vend.serial == serial){
                    vend.terms = selected_vendor_info[0].payment_term + ' days';
                    vend.discount = selected_vendor_info[0].discount;
                }
            });

            console.log(ref.vendor_list);

        },
        markupTypeCheck: function(){
            let ref = this;
            if (isNaN(ref.markup)) {
                ref.markup = '';
            }
        },

        final_price_calculate: function(){
            let ref = this;
            ref.price_without_tax = parseFloat(ref.final_cost) + parseFloat((ref.final_cost * ref.markup)/100);
            ref.final_price = parseFloat(ref.price_without_tax) + parseFloat((ref.price_without_tax * ref.tax)/100);

        },

        vendorInc: function(){
           let ref = this;
           let new_vend = {
                serial: '',
                id: '',
                price: '',
                terms: ''
            };
            let count = ref.vendor_list.length;

            new_vend.serial = count + 1;

            ref.vendor_list.push(new_vend);
            // console.log(ref.vendor_list);
        },
        removeVendor: function(serial){
            let ref = this;
            ref.vendor_list = ref.vendor_list.filter(function(vendor_item){
                return vendor_item.serial != serial;
            });
        },
        getInputName: function(index, dataName){
          return "vendors["+index+"]["+dataName+"]";
        },

        edit_selected_vendor: function(){
            let ref = this;
            let product_id = ref.edit_product_id;
            axios.post('/api/vendor/data/by/product_id', {'product_id': product_id}).then(function(resposne){
                let data = resposne.data;
                console.log(data);
                ref.vendor_list = [];
                for (var i = 0; i < data.length; i++) {
                   let new_vend = {
                        serial: i+1,
                        id: data[i].vendor_id,
                        price: data[i].vendor_price,
                        terms: data[i].vendor.payment_term,
                        discount: data[i].vendor.discount
                    };
                    ref.vendor_list.push(new_vend);
                }
            });
        },
    },
    created: function(){
    	this.fetch_category();
        this.fetch_unit();
        this.fetch_department();
        this.fetch_vendor();
        this.edit_selected_vendor();
    },
});
</script>
@endpush
