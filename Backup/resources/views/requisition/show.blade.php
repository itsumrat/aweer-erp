@extends('layouts/app')

@section('title', 'Dashboard - Requisition Show')

@section('main_content')
        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Requistion No. {{ $requisition->id }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card bg-light pt-3 pb-1 pl-2 pr-2">
                                            To: <br>
                                            <address>
                                                <h5>{{ $requisition->requisition_to_location->name }}</h5>
                                                {{ $requisition->requisition_to_location->address }}
                                                 <br>
                                                Dubai 9999, UAE <br>
                                                Tel: {{ $requisition->requisition_to_location->phone }} <br>
                                                Email: {{ $requisition->requisition_to_location->email }}
                                            </address>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card bg-light pt-3 pb-1 pl-2 pr-2">
                                            From: <br>
                                            <address>
                                            <address>
                                                <h5>{{ $requisition->requisition_from_location->name }}</h5>
                                                {{ $requisition->requisition_from_location->address }}
                                                 <br>
                                                Dubai 9999, UAE <br>
                                                Tel: {{ $requisition->requisition_from_location->phone }} <br>
                                                Email: {{ $requisition->requisition_from_location->email }}
                                            </address>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        Reference: {{ $requisition->reference }} <br>
                                        Date : {{ $requisition->date }} <br>
                                        Status: {{ ($requisition->status == 1)?'Pending':'Sent' }}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-xs-12 text-right order_barcodes">
                                            <img src="https://5a135-0f-akt3r-9r0up.com/admin/misc/barcode/UlFTTjAxMDAwMjQ2/code128/74/0/1" alt="RQSN01000246" class="bcimg">
                                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAF4AAABeCAYAAACq0qNuAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAEL0lEQVR4nO1c247rMAiMj/b/f7nnKVIU2WYYwNBdRlpp2zrYmQDm4nZ8Pp/P1TiOf9kL+Kto4pPQxCehiU9CE5+EJj4JTXwSmvgkNPFJaOKT0MQnoYlPQhOfhB/2wjEGPemzIPqUgxRKZ/Ou5GnmZe+HLe62xieB1ngrVhomafTuGq9xJ+BCPOsiPOZiXMtMDvoZMi8CN41HCWBlMD4ZtarZ+jzuZ4c0V3Mv3uMGK7gOLcr5+L+CUlGN5HfvP0kGMiYbaRo/w9sKNFahyQcqWFu6j7/BbJ4VNJdFCR/PElhBc1m4Ee+tfUjUg67hbUHIWqOtyYX4CM1jZGoy092DOGFJpaKaFd7ESK+/AV9BvDbakcZX2BtG1UOrq2LZykUwZGbe+pF6vLbevSIkei+ZPVjpNYtSCdQKyINDNshKxn2E+CifaqmvM9VNz/ugiZ/F2RrTlDRyFbmgN8/kAeh15crCaLSxW7hXB0rT4dJ8vppPCzPxkoawmifNd8NS09ESZ2mKv2EmHukaoWR5dKDYiiYzfoxBa33I5jojxrP2wo7Twpon7HDsXE1ktmjpv2Yh7JQBWgFEXYgmypF8sZeFpCdQT19uOaGljZvRDNei7VGWcjRz3VkG+8DYczYWlI/jV689wzLPKAbdTD3i+JCyMFsvf54QQE4LoPIqafoNuiwcGSVomt2Sa4mOZlJPC6OZoTWD9LAA7fueFvNEaM8VjS5QrYyucp6a77qCq5OIDA+X8l7T7j0p/r+h7YBpkfKNEE8ZnjI9Kpcojp2Pf4+TNAfVVA//u7IozXq1OHquRvKlCAE7ed6bYGQs7+rjV2NW45hwT1PltFhYdM823Md7ZZaMqUv9gMiyr4Swevzqfa96PNM9uq6YfgCDEOK1nSeLfNQSvGL19NYfqkGreH/2/06eZb7VGPZz7bgZQms12lqKV23FU84NtEGD4uihVbQrxfrvCDmWcTscJf5UrWWM4ZZZz+R4yHbPXD1OF7DXoacbmPVKcrQI/Wb36V7nruOFyEYy6/f7xzNXBjuNRK9/Q9ub1WTQkY2Uo8RLViE9BPahsVXHyGy2VM8Vlff+TDufZT3PrlS5ZjeKqGgkCp7rS/sOVPT5F23itrves/N0I/03yRDZaBXRshkye02JcNKCqOjB05jZfGSFEsQjQG4YieMt+UG5OB6ZnAkFNedgrJqordNY50v7TTLLZsU8RLS7dQpf42okTdNmwNlha2nio2o9HpGPFWWI17QJIxodErxPHZQg3no+ho2rZ/NGdMRmKEH8DKhPR33+aQuRUJb4Cn54lRc8kV6PP1HyQU6ASdefciUSyv4mGTOP9eGffAilXI3HCTSt79f2ZJH1Iij701i/HV/xY3C/EU18Epr4JDTxSWjik9DEJ6GJT0ITn4QmPglNfBKa+CQ08Ulo4pPwH7clZDorX9UTAAAAAElFTkSuQmCC" alt="https://5a135-0f-akt3r-9r0up.com/admin/quotes/view/248" class="qrimg">                  
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <table class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Item name (Item code)</th>
                                                    <th>Final Cost</th>
                                                    <th>Stock</th>
                                                    <th>Quantity</th>
                                                    <th>Last 7 days avg sale</th>
                                                    <th>Last 30 days avg sale</th>
                                                    <th>Subtotal(AED)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $total = 0  @endphp
                                                @foreach($requisition->requisition_items as $item)
                                                <tr>
                                                    <td>{{ $item->item->name }}</td>
                                                    <td>{{ $item->item->prices->final_cost }}</td>
                                                    <td>0</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>{{ $item->item->prices->final_cost * $item->quantity }}</td>
                                                </tr>
                                                @php
                                                    $total +=  $item->item->prices->final_cost * $item->quantity;
                                                @endphp
                                                @endforeach
                                                
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6" style="text-align:right; padding-right:10px;">Total                                (AED)
                                                    </td>
                                                    <td style="text-align:right; padding-right:10px;">{{ $total }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" style="text-align:right; padding-right:10px; font-weight:bold;">Total Amount (AED)
                                                    </td>
                                                    <td style="text-align:right; padding-right:10px; font-weight:bold;">{{ $total }}
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="col-md-4 offset-md-8">
                                            <div class="card bg-light pt-3 pb-1 pl-2 pr-2">
                                                <p>Created by: Abu Shagara 2151</p>
                                                <p>Date: {{ $requisition->created_at }}</p>
                                                <p>Updated by: Abu Shagara 2151</p>
                                                <p>Updated at: {{ $requisition->updated_at }}</p>
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

@push('js_script')

<script>

const app = new Vue({
    el: '#page-content',
    data: {
        test: 'testing',
    },
    methods:{

    },
    created: function(){

    }

});


    
</script>
@endpush