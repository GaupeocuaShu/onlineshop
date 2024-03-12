@extends('admin.layout.master')

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
            <h2 class="section-title">Brand</h2>

            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Brand</h4>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="{{ route('admin.brand.update', $brand->id) }}"
                                method="post">
                                @method('PUT')
                                @csrf
                                <img src="{{ asset($brand->logo) }}" width="200px" class="my-3" />
                                <div class="form-group">
                                    <label for="">Logo</label>
                                    <input name="logo" type="file" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input value="{{ $brand->name }}" name="name" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Is Featured</label>
                                    <select name="is_featured" class="form-control">
                                        <option {{ $brand->is_featured == 1 ? 'selected' : ' ' }} value="1">Yes
                                        </option>
                                        <option {{ $brand->is_featured == 0 ? 'selected' : ' ' }} value="0">No
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control">
                                        <option {{ $brand->status == 1 ? 'selected' : ' ' }} value="1">Active
                                        </option>
                                        <option {{ $brand->status == 0 ? 'selected' : ' ' }} value="0">Inactive
                                        </option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.brand.index') }}" class="ml-2 btn btn-danger text-white"> Back
                                </a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
