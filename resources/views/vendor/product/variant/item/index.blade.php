@extends('vendor.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Variant Item table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Product Variant Item</div>
            </div>
        </div>
        <a class="btn btn-primary" href="{{ route('vendor.product.variant.index', $productID) }}"><i
                class="fa-solid fa-backward"></i> </a>
        <div class="section-body">
            <h2 class="section-title">{{ $variant->name }}</h2>

            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h4>Simple Table</h4>
                            <div class="card-header-action">
                                <a href="{{ route('vendor.product.variant.item.create', [$productID, $variant->id]) }}"
                                    class="btn btn-primary">
                                    Create
                                    New</a>
                            </div>
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
