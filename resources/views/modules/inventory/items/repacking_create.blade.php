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
                                <a class="nav-link"  href="{{ route('combo.create') }}" role="tab" aria-controls="pills-combo" aria-selected="false">Attach Barcode</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active"  href="{{ route('repacking.create') }}" role="tab" aria-controls="pills-repacking" aria-selected="false">Costing & Pricing</a>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="col-7">
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
                                                <div class="col-12 mt-1">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Barcode*</label>
                                                                <input type="text" class="form-control" name="barcode" v-model="fetchbarcode" v-on:keyup="fetch_product_barcode">
                                                                @error('fetchbarcode')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Item Unit*</label>
                                                                <input type="text" class="form-control" name="unit_id" v-model="unitname" readonly="">
                                                                @error('unit_id')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Item Code</label>
                                                                <input type="text" class="form-control" name="code" v-model="itemcode" readonly>
                                                                @error('code')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="hidden" name="product_id" v-model="barcodeitem.id" />
                                                            <div class="form-group">
                                                                <label for="exampleFormControlInput1">Item Name</label>
                                                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="name" v-model="itemname" readonly required>
                                                            @error('name')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-1">
                                                    <h6 class="mb-2 text-muted">Costing & Pricing</h6>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Cost with Tax</label>
                                                                <input readonly="readonly" type="text" class="form-control" name="cost_with_tax" v-model="itemcost" value="{{ old('cost_with_tax') }}">
                                                                @error('cost_with_tax')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Calculated Cost</label>
                                                                <input readonly="readonly" type="text" class="form-control" name="final_cost" v-model="final_cost" value="{{ old('final_cost') }}">
                                                                @error('final_cost')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Markup</label>
                                                            <div class="input-group">
                                                              <input type="text" class="form-control" name="markup"
                                                              v-model="markup" name="markup" v-on:keyup='markupTypeCheck(); final_price_calculate()'aria-describedby="basic-addon1">
                                                              <div style="height: 34px" class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">%</span>
                                                              </div>
                                                            </div>
                                                            @error('markup')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Final Price</label>
                                                                <input readonly="readonly" type="text" class="form-control" name="final_price" v-model="final_price">
                                                                @error('final_price')
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
                            <div class="col-5">
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="text-muted">Latest 100 Barcodes</h6>
                                        <div style="width:100%; height:500px; overflow: auto;">
                                            <table class="table">
                                                <tr>
                                                    <th>Barcode</th>
                                                    <th>Item Code</th>
                                                    <th>Item Name</th>
                                                    <th>UOM</th>
                                                </tr>
                                                <tr v-for="product in products">
                                                    <th>@{{ product.barcode }}</th>
                                                    <th>@{{ product.product_pricing.code }}</th>
                                                    <th>@{{ product.product_pricing.name }}</th>
                                                    <th>@{{ product.unit_price.name }}</th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
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
       products: [],
       fetchbarcode: '',
       barcodeitem: {},
       itemcode: '',
       itemname: '',
       unitname: '',
       itemcost: '',
       final_cost: '{{ old('final_cost') }}',
       markup: '{{ old('markup') }}',
       final_price: '{{ old('final_price') }}'

    },
    mounted() {
        this.getAllproducts();
    },
    methods:{
        getAllproducts: function(){
            var ref = this;
            ref.products = null;
            let url = '/api/allproductswithbarcode';
            axios.get(url).then(function(resposne){
                ref.products = resposne.data; 
                console.log(ref.products);
            });


        },

        fetch_product_barcode: function(){
            let ref = this;
            let barcode = ref.fetchbarcode;
            console.log(barcode);
            ref.barcodeitem = {};
            axios.post('/api/fetchproductbarcode', {'barcode':barcode}).then(function(resposne){
                ref.barcodeitem = resposne.data;
                console.log(ref.barcodeitem);
                ref.unitname = ref.barcodeitem.unit_price.name;
                ref.itemcost = ref.barcodeitem.costs.cost_with_tax;
                ref.itemcode = ref.barcodeitem.product_pricing.code;
                ref.itemname = ref.barcodeitem.product_pricing.name;
                ref.markup = ref.barcodeitem.markup;
                ref.final_price = ref.barcodeitem.final_price;
                ref.final_cost = ref.barcodeitem.costs.cost_with_tax * ref.barcodeitem.unit_price.note;
                
            });
        },
        markupTypeCheck: function(){
            let ref = this;
            if (isNaN(ref.markup)) {
                ref.markup = '';
            }
        },

        final_price_calculate: function(){
            let ref = this;
            ref.final_price = parseFloat(ref.final_cost) + parseFloat((ref.final_cost * ref.markup)/100);

        }
    },

    created: function(){

    },
});


// jquery
// $('.vendor_select2').select2();
</script>
@endpush
