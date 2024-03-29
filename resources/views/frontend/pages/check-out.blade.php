@extends('frontend.layout.mastercart')
@section('content')
    <div class ="py-8 relative min-h-screen">
        {{-- Loading --}}
        <div role="status" class="loading absolute w-full h-full hidden items-center justify-center bg-[#eeeeee7d]">
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

        @if (\Cart::getTotalQuantity() > 0)
            <div class="bg-white py-3 px-10 ">
                <ul class="flex justify-between">
                    <li class="w-[45%]">Product Ordered</li>
                    <li>Price Quotation</li>
                    <li>Quantity </li>
                    <li>Sub Total</li>
                </ul>
            </div>
            @foreach ($vendors as $vendor)
                <div class="bg-white py-3 my-3 px-10">
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
            <div class="flex items-center">
                <h1 class="text-xl mr-10">Payment Method</h1>
                <button class="border-2 border-slate-200 py-2 mr-3 px-4">Credit Card/Debit Card</button>
                <button class="border-2 border-slate-200 py-2 px-4">Cash On Delivery</button>
            </div>
            <div class="my-10 flex flex-col items-end border-y-2 border-slate-200 py-5 gap-y-6">
                <div class="w-[300px] flex justify-between"><span>Merchandise Subtotal </span><span
                        class="ml-10">$375.000</span> </div>
                <div class="w-[300px] flex justify-between"><span>Voucher</span><span class="ml-10 text-red-600">-$5</span>
                </div>
                <div class="w-[300px] flex justify-between"><span>Total </span><span
                        class="ml-10 text-sky-600 text-xl">$375.000</span> </div>
            </div>
            <div class="flex justify-between items-center">
                <p>
                    By clicking "Place Order", you are agreeing to <a class="text-sky-700" href="#">ShuTy's Shop
                        General Transaction Terms</a>
                </p>
                <button class="bg-sky-600 text-white py-3 px-10">
                    Place Order
                </button>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {});
    </script>
@endpush
