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
            <h2 class="section-title">Slider</h2>

            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create slider</h4>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="{{ route('admin.slider.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Banner</label>
                                    <input name="banner" type="file" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input name="title" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Start Price</label>
                                    <input name="start_price" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Button URL</label>
                                    <input name="btn_url" type="text" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">Serial</label>
                                    <input name="serial" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
