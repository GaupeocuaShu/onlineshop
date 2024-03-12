@extends('admin.layout.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Slider</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Update Slider</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Update Slider</h2>

            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update slider</h4>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="{{ route('admin.slider.update',$slider->id) }}" method="POST">
                                @csrf
                                @method("PUT")

                                <div class="form-group">
                                    <div class="my-3">
                                        <img width="300" alt="{{$slider->name}}" src="{{asset($slider->banner)}}"/> 
                                    </div>
                                    <label for="">Banner</label>
                                    <input value="{{$slider->banner}}" name="banner" type="file" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input value="{{$slider->name}}" name="name" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">URL</label>
                                    <input value="{{$slider->url}}" name="url" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Serial</label>
                                    <input value="{{$slider->serial}}" name="serial" type="number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control">
                                        <option {{$slider->status == 1 ? "selected" :" "}} value="1">Active</option>
                                        <option {{$slider->status == 0 ? "selected" :" "}} value="0">Inactive</option>
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
