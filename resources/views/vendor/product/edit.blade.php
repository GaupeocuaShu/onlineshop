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
            <h2 class="section-title">Product</h2>

            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Product</h4>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="{{ route('vendor.product.update', $product->id) }}"
                                method="POST">
                                @method('PUT')
                                @csrf
                                <div>
                                    <img src="{{ asset($product->thumb_image) }}" width="200" />
                                </div>
                                <div class="form-group mt-2">
                                    <label for="">Image</label>
                                    <input name="thumb_image" type="file" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input value="{{ $product->name }}" name="name" type="text" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="">Category</label>
                                        <select name="category_id" class="form-control main_category">
                                            <option value=""> Select </option>
                                            @foreach ($categories as $category)
                                                <option {{ $category->id == $product->category_id ? 'selected' : ' ' }}
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Sub Category</label>
                                        <select name="sub_category_id" class="sub_category form-control">
                                            <option value="">Select </option>
                                            @foreach ($subCategories as $subCategory)
                                                <option
                                                    {{ $subCategory->id == $product->sub_category_id ? 'selected' : '' }}
                                                    value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Child Category</label>
                                        <select name="child_category_id" class="child_category form-control">
                                            <option value="">Select </option>
                                            @foreach ($childCategories as $childCategory)
                                                <option
                                                    {{ $childCategory->id == $product->child_category_id ? 'selected' : ' ' }}
                                                    value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Product type</label>
                                    <select name="product_type" class="form-control">
                                        <option {{ $product->product_type == 'none' ? 'selected' : ' ' }} value="">
                                            Select </option>
                                        <option {{ $product->product_type == 'new_arrival' ? 'selected' : ' ' }}
                                            value="new_arrival">New
                                            Arrival
                                        </option>
                                        <option {{ $product->product_type == 'top' ? 'selected' : ' ' }} value="top">Top
                                            Product</option>
                                        <option {{ $product->product_type == 'best' ? 'selected' : ' ' }} value="best">
                                            Best Product</option>
                                        <option {{ $product->product_type == 'featured' ? 'selected' : ' ' }}
                                            value="featured">Featured
                                            Product</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Brands</label>
                                    <select name="brand_id" class="form-control">
                                        <option value=""> Select </option>
                                        @foreach ($brands as $brand)
                                            <option {{ $brand->id == $product->brand_id ? 'selected' : '' }}
                                                value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Quantity</label>
                                    <input value="{{ $product->qty }}" name="qty" type="number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Short Description</label>
                                    <textarea class="summernote" name="short_description">{{ $product->short_description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Long Description</label>
                                    <textarea class="summernote" name="long_description">{{ $product->long_description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Video Link</label>
                                    <input value="{{ $product->video_link }}" name="video_link" type="text"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">SKU</label>
                                    <input value="{{ $product->sku }}" name="sku" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Price</label>
                                    <input value="{{ $product->price }}" name="price" type="text"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Offer Price</label>
                                    <input value="{{ $product->offer_price }}" name="offer_price" type="text"
                                        class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="">Offer Start Price</label>
                                        <input value="{{ $product->offer_start_price }}" name="offer_start_price"
                                            type="date" class="form-control">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">Offer End Price</label>
                                        <input value="{{ $product->offer_end_price }}" name="offer_end_price"
                                            type="date" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Seo Title</label>
                                    <input value="{{ $product->seo_title }}" name="seo_title" type="text"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control main_category">
                                        <option {{ $product->status == 1 ? 'selected' : ' ' }} value="1"> Active
                                        </option>
                                        <option {{ $product->status == 0 ? 'selected' : ' ' }}value="0"> Inactive
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Seo Description</label>
                                    <input value="{{ $product->seo_description }}" name="seo_description" type="text"
                                        class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('vendor.product.index') }}" class="ml-2 btn btn-info text-white"> Back
                                </a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
