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
            <h2 class="section-title">Category</h2>

            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Category</h4>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="{{ route('admin.category.update', $category->id) }}"
                                method="post">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="">Icon</label>
                                    <div><i style="font-size: 40px" class="{{ $category->icon }}"> </i></div>
                                    <div class="mt-3" data-align="left" data-cols="20" data-icon="{{ $category->icon }}"
                                        name="icon" data-selected-class="btn-danger" data-unselected-class="btn-info"
                                        role="iconpicker">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <div class="my-3"><img alt="{{ $category->name }}" src="{{ asset($category->image) }}"
                                            width="400" /></div>
                                    <input name="image" type="file" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input value="{{ $category->name }}" name="name" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control">
                                        <option {{ $category->status == 1 ? 'selected' : ' ' }} value="1">Active
                                        </option>
                                        <option {{ $category->status == 0 ? 'selected' : ' ' }} value="0">Inactive
                                        </option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.category.index') }}" class="ml-2 btn btn-info text-white"> Back
                                </a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
