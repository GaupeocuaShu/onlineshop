@extends('vendor.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Image Gallery</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Product Image Gallery</div>
            </div>
        </div>
        <a href="{{ route('vendor.product.index') }}"> <button class="btn btn-primary mb-3"><i
                    class="fa-solid fa-backward"></i> </button></a>
        <div class="section-body">

            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h4>Upload Image</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('vendor.product.image-gallery.store', $product->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="file" multiple name="images[]" />
                                </div>
                                <button class="btn btn-primary">Upload All</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h4>Simple Table</h4>
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