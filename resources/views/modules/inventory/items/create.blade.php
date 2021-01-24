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
                                <a class="nav-link active" href="{{ route('items.create') }}" role="tab" aria-controls="pills-standard" aria-selected="true">Item Master</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="{{ route('combo.create') }}" role="tab" aria-controls="pills-combo" aria-selected="false">Attach Barcode</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('repacking.create') }}" aria-controls="pills-repacking" aria-selected="false">Costing & Pricing</a>
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
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Item Code*</label>
                                                        <input type="text" class="form-control" name="code" value="{{ old('code') }}">
                                                        @error('code')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Item Name*</label>
                                                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="name" value="{{ old('name') }}">
                                                    @error('name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Short Description</label>
                                                        <input type="text" class="form-control" name="short_description" value="{{ old('short_description') }}">
                                                        @error('short_description')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Deptwise Category</label>
                                                        <select class="form-control" name="dept_wise_category">
                                                            <option value="1">Food</option>
                                                            <option value="2">Non Food</option>
                                                            <option value="3">Frozen</option>
                                                            <option value="4">Electronics</option>
                                                            <option value="5">Germents</option>
                                                            <option value="6">Vegetables</option>
                                                            
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
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Evaluation</label>
                                                        <select class="form-control" name="evalucation">
                                                            <option>Fast Moving</option>
                                                            <option>Slow Moving</option>
                                                            <option>Non Moving</option>
                                                        </select>
                                                        @error('evalucation')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-1">
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
                                                            <input type="number" class="form-control" name="alert_quantity" value="{{ old('alert_quantity') }}">
                                                            @error('alert_quantity')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="col-12 mt-1">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Tax %</label>
                                                        <input type="text" class="form-control" name="tax_amount" v-model="tax" v-on:keyup="" value="{{ old('tax') }}">
                                                        @error('tax_amount')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Purchase Given Cost (-Tax)</label>
                                                        <input type="text" class="form-control" name="purchase_cost" v-model="purchase_cost" v-on:keyup="final_price_calculate" value="{{ old('final_cost') }}">
                                                        @error('purchase_cost')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Cost with Tax</label>
                                                        <input type="text" class="form-control" name="cost_with_tax" v-model="cost_with_tax" value="{{ old('cost_with_tax') }}">
                                                        @error('cost_with_tax')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                    </div>
                                                </div>
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
        purchase_cost: '{{ old('purchase_cost') }}',
        cost_with_tax: '{{ old('cost_with_tax') }}',
        price_without_tax: '{{ old('price_without_tax') }}',
        tax: '{{ $tax }}',



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

        final_price_calculate: function(){
            let ref = this;
            ref.price_without_tax = parseFloat(ref.purchase_cost);
            ref.cost_with_tax = parseFloat(ref.price_without_tax) + parseFloat((ref.price_without_tax * ref.tax)/100);

        }
    },
    created: function(){
    	this.fetch_category();
        this.fetch_unit();
        this.fetch_department();

    },
});
</script>
@endpush
