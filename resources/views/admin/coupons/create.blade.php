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
                            <h4>Create Category</h4>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="{{ route('admin.coupons.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input name="name" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">code</label>
                                    <input name="code" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Quantity</label>
                                    <input name="quantity" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Max use per person</label>
                                    <input name="max_use" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Start date</label>
                                    <input name="start_date" type="date" class="datepicker form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">End date</label>
                                    <input name="end_date" type="date" class="datepicker form-control">
                                </div>
                                <div class="row ">
                                    <div class="form-group col-md-4">
                                        <label for="">Discount_type</label>
                                        <select name="discount_type" class="discount__type form-control">
                                            <option value="percentage">Percentage (%)</option>
                                            <option value="amount">Amount</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-8">
                                        <label>Discount</label>
                                        <div class="input-group">
                                            <input name="discount" type="text" class="form-control currency">
                                            <div class="input-group-prepend">
                                                <div class="discount input-group-text">
                                                    $
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Create</button>
                                <a href="{{ route('admin.coupons.index') }}" class="ml-2 btn btn-info text-white"> Back
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $("body").on("change", ".discount__type", function() {
                const type = $(this).val();
                if (type == "percentage") $(".discount").html("%");
                else {
                    $(".discount").html("$");
                }
            });
        });
    </script>
@endpush
