@extends('admin.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Flash Sell Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Flash Sell</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Flash Sell Information</h2>

            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h4>Select Flash Sale Time</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <form action="{{ route('admin.flash_sell.update') }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <label>Flash Sale End Date</label>
                                    <input value="{{ $endDate }}" type="date" name="end_date"
                                        class="form-control datepicker">
                                    <button class="btn btn-primary mt-3">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Select Sale Products</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <form action="{{ route('admin.flash_sell.store') }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div>
                                        <label>Available Products</label>
                                        <select name="product_id" class="form-control select2">
                                            <option value="">Select</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <label>Show at home?</label>
                                        <select name="show_at_home" class="form-control select2">
                                            <option value="">Select</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary mt-3">Store</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Flash Sale Products</h4>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
