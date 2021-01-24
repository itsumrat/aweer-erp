@extends("layouts.app")

@section("title", "Aweer Inventory - Department")


@section("main_content")

        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Tax</h5>
                                <div class="title-icons">
                                    
                                </div>
                            </div>
                            <div class="card-body">
                            @if(session('success'))
                                                <h1 class="text-success">{{session('success')}}</h1>
                                            @endif
                                            @if(session('error'))
                                                 <h1 class="text-danger">{{session('error')}}</h1>
                                            @endif

                                <form action="{{ route('tax.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="input-group flex-nowrap">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input type="number" class="form-control" name="tax_amount" value="{{ isset($tax->amount)?$tax->amount:'' }}">

                                            </div>
                                            @error('tax_amount')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
   
@endsection


@push("script")

@endpush