@php
    \Cart::session('checked');
@endphp
@extends('frontend.layout.mastercart')
@section('content')
    <div class ="py-8 relative min-h-screen">
        {{-- Freeze Screen --}}
        <div class="freeze-screen hidden w-screen h-screen bg-[#3232325a] fixed top-0 left-0"></div>
        {{-- Freeze Screen --}}
        {{-- Loading --}}
        <div role="status" class="loading  absolute w-full h-full hidden  items-center justify-center bg-[#eeeeee7d]">
            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
            <div class=" text-black">&emsp;Loading...</div>
        </div>
        {{-- Loading --}}
        <div class="bg-white my-3 px-10 py-5 border-t-[3px] border-sky-700">
            <h1 class="text-sky-600 text-xl font-semibold"><i class="fa-solid fa-globe"></i>&ensp;Delivery Address</h1>
            <div class="py-3 text-base">
                <span class="font-semibold deliver-name">{{ $address->name . ' (+1) ' . $address->phone }}</span> &emsp;
                <span
                    class="deliver-address">{{ $address->address . ', ' . $address->city . ' City, ' . $address->state . ' State, ' . $address->zip }}</span>
                &emsp;<button class="text-sky-700 hover:underline change-address">Change</button>
            </div>
            {{-- Select Address --}}
            <div
                class="shadow-2xl hidden rounded-lg select-address-panel absolute w-[60%] min-h-[70%] bg-white top-[30%] p-10 left-[50%] -translate-y-[50%] -translate-x-[50%]">
                <h1 class="text-2xl pb-3 border-b-2 border-slate-200">My Address</h1>
                <form class="h-full">
                    <div class="addresses flex flex-col h-full justify-between">
                        <div class="pb-3">
                            @foreach ($addresses as $addr)
                                <div
                                    class="py-5 flex address-{{ $addr->id }} address flex items-center  justify-between border-b-2 borde-slate-200">
                                    <div class="leading-[30px]">
                                        <p><span class="text-xl name">{{ $addr->name }}</span> &ensp;| &ensp;<span
                                                class="phone">(+1)
                                                {{ $addr->phone }}</span></p>
                                        <p class="address">{{ $addr->address }}</p>
                                        <p class="mb-3 country">
                                            {{ $addr->country . ', ' . $addr->state . ' State, ' . $addr->city . ' City, ' . $addr->zip }}
                                        </p>

                                        <span
                                            class="default {{ $addr->is_default == 1 ? 'inline' : 'hidden' }} text-sm border-sky-500 border-2 p-2  text-sky-500">Default</span>

                                    </div>
                                    <div>
                                        <input {{ $addr->is_default == 1 ? 'checked' : ' ' }} type="radio" name="id"
                                            value="{{ $addr->id }}" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="my-5 self-end ">
                            <button
                                class="border-sky-600 close-address-panel border-2 py-2 px-10 text-sky-600 ">Cancel</button>&emsp;
                            <button
                                class="bg-sky-600 hover:bg-sky-700  border-sky-600 border-2  text-white py-2 px-10 confirm">Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
            {{-- Select Address --}}

        </div>
        @if (\Cart::getTotalQuantity() > 0)
            <div class="bg-white py-3 px-10 ">
                <ul class="flex justify-between items-center">
                    <li class="w-[45%] text-2xl">Product Ordered</li>
                    <li>Price Quotation</li>
                    <li>Quantity </li>
                    <li>Sub Total</li>
                </ul>
            </div>
            @foreach ($vendors as $vendor)
                <div class="bg-white py-3 px-10">
                    <h1 class="border-b-2 border-slate-200 py-4">
                        <i class="fa-solid fa-shop"></i>&emsp;{{ $vendor['name'] }}
                    </h1>
                    <div class="vendor-items">
                        @foreach (Cart::getContent() as $cartItem)
                            @php
                                $product = App\Models\Product::findOrFail($cartItem->attributes['product_id']);
                            @endphp
                            @if ($cartItem->attributes['vendor_id'] == $vendor['id'])
                                <div class="my-5 flex justify-between items-center pb-3 border-b-2 border-slate-200">
                                    <div class="w-[45%] flex items-center gap-10">
                                        <span class="w-[15%] flex items-center">
                                            <img width="100"
                                                src="{{ asset($cartItem->attributes['imageURL']) }}" /></span>
                                        <span class="flex-1">{{ $cartItem->name }}</span>
                                        <div class="flex-1">
                                            @foreach ($cartItem->attributes as $key => $item)
                                                @if ($key != 'brand_id' && $key != 'product_id' && $key != 'vendor_id' && $key != 'imageURL')
                                                    <span
                                                        class="capitalize">{{ $key }}:&emsp;{{ $item }}</span>
                                                    </br />
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <span>$<span
                                            class="price-quotation-{{ $cartItem->id }}">{{ $cartItem->price }}</span></span>
                                    <span>{{ $cartItem->quantity }}</span>
                                    <span class="text-sky-600">$<span
                                            class="price-sum price-sum-{{ $cartItem->id }}">{{ $cartItem->getPriceSum() }}</span></span>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            @endforeach
        @else
            <div class="bg-white flex justify-center flex-col items-center h-[30vh] text-2xl">
                <p>
                    <i class="fa-solid fa-circle-xmark"></i> &ensp;Your Cart Is Empty &ensp;<i
                        class="fa-regular fa-face-sad-tear"></i>
                </p>
                <a class="bg-sky-600 hover:bg-sky-700 hover:-translate-y-1 text-white py-3 px-4 my-5 text-xl rounded-lg "
                    href="/">Go
                    Shopping</a>
            </div>
        @endif
        <div class="bg-white py-3 px-10 ">
            <div id="tabs">
                <div class="flex gap-x-10 items-start my-5">
                    <h1 class="text-xl">Payment Method</h1>
                    <ul class="flex ">
                        <li><a href="#tabs-1" data-method="cash"
                                class="border-2 tab border-slate-200 py-2 mr-3 px-4 active">Cash On
                                Delivery</a>
                        </li>
                        <li><a href="#tabs-2" data-method ="card"
                                class="border-2 tab border-slate-200 py-2 mr-3 px-4">Credit Card/Debit
                                Card</a>
                        </li>
                    </ul>
                </div>
                <div class="my-10">
                    <div id="tabs-1">
                        <div class="flex gap-x-10">
                            <span class="text-sky-700">Cash on Delivery</span>
                            <span>You will be charged extra $0 for this payment method.</span>
                        </div>
                    </div>
                    <div id="tabs-2">
                        <p>Sorry, This Method Is Not Available</p>
                    </div>

                </div>
            </div>

            <div class="my-10 flex flex-col items-end border-y-2 border-slate-200 py-5 gap-y-6">
                <div class="w-[300px] flex justify-between"><span>Merchandise Subtotal: </span><span
                        class="ml-10">${{ \Cart::getSubTotal() }}</span> </div>

                @if (count(\Cart::getConditions()) > 0)
                    @foreach (\Cart::getConditions() as $con)
                        <div class="w-[300px] flex justify-between capitalize"><span>{{ $con->getType() }}:</span><span
                                class="ml-10 text-red-600">
                                {{ $con->getValue() }}
                            </span>
                        </div>
                    @endforeach
                @endif
                <div class="w-[300px] flex justify-between"><span>Total Payment: </span><span
                        class="ml-10 text-sky-600 text-4xl">${{ \Cart::getTotal() }}</span> </div>
            </div>
            <div class="flex justify-between items-center">
                <p>
                    By clicking "Place Order", you are agreeing to <a class="text-sky-700" href="#">ShuTy's Shop
                        General Transaction Terms</a>
                </p>
                <form action="{{ route('user.payment.make-payment') }}" method="POST">
                    @csrf
                    <input name="order_address" value="{{ $address->id }}" type="hidden" />
                    <input name="payment_method" value="cash" type="hidden" />
                    <input name="payment_status" value="0" type="hidden" />
                    <button class="bg-sky-600 text-white py-3 px-10 hover:bg-sky-800 rounded-sm">
                        Place Order
                    </button>
                </form>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $(function() {
                $("#tabs").tabs();
            });


            $(".tab").on("click", function() {
                $(".tab").removeClass("active");
                $(this).addClass("active");
                const method = $(this).data('method');
                $('input[name="payment_method"]').val(method);
            })
            $(".change-address").on("click", function() {
                $(".select-address-panel").show();
                $(".freeze-screen").show();
            });
            $(".close-address-panel").on("click", function(e) {
                e.preventDefault();
                $(".select-address-panel").hide();
                $(".freeze-screen").hide();
            });
            $(".confirm").on("click", function(e) {
                e.preventDefault();
                const id = $(this).closest('form').find('input[type="radio"]:checked').val();
                $('input[name="order_address"]').val(id);
                $(".select-address-panel").hide();
                $(".freeze-screen").hide();
                $.ajax({
                    type: "GET",
                    url: "{{ route('user.address.get') }}",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        $(".loading").removeClass("hidden").addClass("flex");
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            const address = response.address;
                            $(".deliver-name").html(`
                               ${address.name} (+1) ${address.phone } 
                            `)
                            $(".deliver-address").html(`
                             ${address.address}, ${address.city} City, ${address.state} State, ${address.zip}
                            `);
                            $(".loading").removeClass("flex").addClass("hidden");
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.table(jqXHR)
                    }
                });
            });
        });
    </script>
@endpush
