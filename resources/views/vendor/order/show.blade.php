@extends('vendor.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Invoice</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Invoice</div>
            </div>
        </div>

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Invoice</h2>
                                <div class="invoice-number">Order #{{ $order->invoice_id }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Billed To:</strong> <br>

                                        <b>Address:&emsp;</b>{{ $address->address }}<br>
                                        <b>Zip:&emsp;</b>{{ $address->zip }}<br>
                                        <b>Country:&emsp;</b>{{ $address->state }} - {{ $address->country }}
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Order Date:</strong><br>

                                        {{ date('F d,Y', strToTime($order->created_at)) }}<br><br>
                                    </address>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address style="text-transform: capitalize">
                                        <strong>Payment Method:</strong><br>
                                        <b>Method:&emsp;</b>{{ $transaction->payment_method }}<br>
                                        <b>Transaction ID:&emsp;</b>{{ $transaction->transaction_id }} <br>

                                    </address>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">Order Summary</div>
                            <p class="section-lead">All items here cannot be deleted.</p>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tbody>
                                        <tr>
                                            <th data-width="40" style="width: 40px;">#</th>
                                            <th>Item</th>
                                            <th class="text-center">Variant</th>
                                            <th>Vendor Name</th>

                                            <th class="text-center">Quantity</th>
                                            <th class="text-right">Totals</th>
                                        </tr>
                                        @foreach ($orderProducts as $key => $product)
                                            @php
                                                $variants = json_decode($product->variants);
                                                $vendorName = $product->vendor->name;

                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $product->product_name }}</td>
                                                <td>
                                                    @if (empty($variants))
                                                        None
                                                    @else
                                                        @foreach ($variants as $key => $item)
                                                            <div>
                                                                <b> {{ $key }}: </b>
                                                                <span class="ml-2"> {{ $item->name }} &emsp;
                                                                    ({{ $currencyIcon }}{{ $item->price }})
                                                                </span>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>{{ $vendorName }}</td>

                                                </td>
                                                <td class="text-center">{{ $product->qty }}</td>
                                                <td class="text-right">{{ $currencyIcon }} {{ $product->unit_price }}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8">
                                    <div class="col-5">
                                        <div class=' form-group'>
                                            <label>Payment Status</label>
                                            <select data-id="{{ $order->id }}" class='payment_status form-control'>
                                                <option {{ $order->payment_status == 0 ? 'selected' : ' ' }}
                                                    value="0">Pending</option>
                                                <option {{ $order->payment_status == 1 ? 'selected' : ' ' }}
                                                    value="1">Succeed</option>
                                            </select>
                                        </div>
                                        <br />
                                        <div class=' form-group'>
                                            <label>Order Status</label>
                                            <select data-id="{{ $order->id }}" class='order_status form-control'>
                                                @foreach (config('order_status.order_status_vendor') as $key => $item)
                                                    <option {{ $order->order_status == $key ? 'selected' : ' ' }}
                                                        value="{{ $key }}">{{ $item['status'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Total</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">
                                            {{ $currencyIcon . ' ' . $total }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-md-right">
                    <div class="float-lg-left mb-lg-0 mb-3">
                        <button class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Process
                            Payment</button>
                        <a href="{{ route('admin.order.index') }}" class="btn btn-danger text-white btn-icon icon-left"><i
                                class="fas fa-times"></i> Cancel</a>
                    </div>
                    <button class="print_btn btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        $(".print_btn").on("click", function() {
            $content = $(".invoice-print").html();
            $original = $("body").html();
            $("body").html($content);
            window.print();
            $("body").html($original);
        });
    </script>
@endpush
