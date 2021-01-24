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
                                        <a class="nav-link active" href="{{ route('items.create') }}" role="tab" aria-controls="pills-standard" aria-selected="true">Standard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"  href="{{ route('combo.create') }}" role="tab" aria-controls="pills-combo" aria-selected="false">Combo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('repacking.create') }}" aria-controls="pills-repacking" aria-selected="false">Repacking</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <form action="{{ route('items.store') }}" method="POST">
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
                                                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="name" value="{{ old('name') }}">
                                                                @error('name')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Item Code*</label>
                                                                    <input type="text" class="form-control" name="code" value="{{ old('code') }}">
                                                                    @error('code')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Barcode*</label>
                                                                    <input type="text" class="form-control" name="barcode" value="{{ old('barcode') }}">
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

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Dept Wise Category</label>
                                                                    <select class="form-control" name="dept_wise_category">
                                                                        <option>Food</option>
                                                                        <option>Non Food</option>
                                                                        <option>Frozen</option>
                                                                        <option>Electronics</option>
                                                                        <option>Germents</option>
                                                                        <option>Vegetables</option>
                                                                        
                                                                    </select>
                                                                    @error('dept_wise_category')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>


                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Generic Description</label>
                                                                    <input type="text" class="form-control" name="generic_description" value="{{ old('generic_description') }}">
                                                                </div>
                                                                @error('generic_description')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Short Description</label>
                                                                    <input type="text" class="form-control" name="short_description" value="{{ old('short_description') }}">
                                                                    @error('short_description')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label>Long Description</label>
                                                                    <input type="text" class="form-control" name="long_description" value="{{ old('long_description') }}">
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
                                                            {{-- <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Quantity</label>
                                                                    <input type="number" class="form-control" name="quantity" value="{{ old('quantity') }}">
                                                                    @error('quantity')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div> --}}

                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Alert Quantity</label>
                                                                    <input type="number" class="form-control" name="alert_quantity" value="{{ old('alert_quantity') }}">
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
                                                                    <input type="text" class="form-control" name="final_cost" v-model="final_cost" v-on:keyup="final_price_calculate" value="{{ old('final_cost') }}">
                                                                    @error('final_cost')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Average Cost</label>
                                                                    <input type="text" class="form-control" name="avg_cost" value="{{ old('avg_cost') }}">
                                                                    @error('avg_cost')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Last GRN Cost</label>
                                                                    <input type="text" class="form-control" name="last_grn_cost" value="{{ old('last_grn_cost') }}">
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
                                                            <h6>Vendor @{{ vendor.serial }} 
                                                                <button class="btn btn-sm" v-on:click="removeVendor(vendor.serial)"><i class="fas fa-minus-circle"></i></button></h6>
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
        vendor_payment_terms:'',
        final_cost: '{{ old('final_cost') }}',
        final_price: '{{ old('final_price') }}',
        price_without_tax: '{{ old('price_without_tax') }}',
        tax: '{{ $tax }}',
        markup: '{{ old('markup') }}',
        vendor_list: [

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

        declearVendorList: function(){
            let ref = this;
            let old_vendor_list = {!! json_encode(old('vendors', [])) !!};
            if(old_vendor_list.length > 0){
            for( var i=0; i< old_vendor_list.length; i++){
                ref.vendor_list.push({
                    serial: i+1,
                    id: old_vendor_list[i].id,
                    price: old_vendor_list[i].price,
                    terms: '',
                    discount: ''
                });
            }
        }else{
                ref.vendor_list.push({
                    serial: 1,
                    id: '',
                    price: '',
                    terms: '',
                    discount: ''
                });
        }
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
        },
        removeVendor: function(serial){
            let ref = this;
            ref.vendor_list = ref.vendor_list.filter(function(vendor_item){
                return vendor_item.serial != serial;
            });
        },
        getInputName: function(index, dataName){
          return "vendors["+index+"]["+dataName+"]";
        }  
    },
    created: function(){
    	this.fetch_category();
        this.fetch_unit();
        this.fetch_department();
        this.fetch_vendor();
        this.declearVendorList();

    },
});


// jquery
// $('.vendor_select2').select2();
</script>
@endpush
