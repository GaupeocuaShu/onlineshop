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
                            <h4>Update slider</h4>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="{{ route('admin.slider.update', $slider->id) }}"
                                method="Post">
                                @csrf
                                @method('PUT')
                                <img src="{{ asset($slider->banner) }}" width="200px" class="my-3" />
                                <div class="form-group">
                                    <label for="">Banner</label>
                                    <input name="banner" type="file" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <input value="{{ $slider->type }}" name="type" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input value="{{ $slider->title }}" name="title" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Start Price</label>
                                    <input value="{{ $slider->start_price }}" name="start_price" type="text"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Button URL</label>
                                    <input value="{{ $slider->btn_url }}" name="btn_url" type="text"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">Serial</label>
                                    <input value="{{ $slider->serial }}" name="serial" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select value="{{ $slider->status }}" name="status" class="form-control">
                                        <option {{ $slider->status == 1 ? 'selected' : ' ' }} value="1">Active</option>
                                        <option {{ $slider->status == 0 ? 'selected' : ' ' }} value="0">Inactive
                                        </option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.slider.index') }}" class="ml-2 btn btn-info text-white"> Back </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
