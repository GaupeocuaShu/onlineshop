@extends('vendor.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Product Variant</h2>
            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Product Variant</h4>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data"
                                action="{{ route('vendor.product.variant.update', [$product->id, $variant->id]) }}"
                                method="Post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Product Name </label>
                                    <input readonly value="{{ $product->name }}" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input value="{{ $variant->name }}" name="name" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select value="{{ $variant->status }}" name="status" class="form-control">
                                        <option {{ $variant->status == 1 ? 'selected' : ' ' }} value="1">Active
                                        </option>
                                        <option {{ $variant->status == 0 ? 'selected' : ' ' }} value="0">Inactive
                                        </option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('vendor.product.variant.index', $product->id) }}"
                                    class="ml-2 btn btn-info text-white">
                                    Back </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
