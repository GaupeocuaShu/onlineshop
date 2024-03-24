@extends('frontend.layout.mastercart')
@section('content')
    <div class ="py-8">
        <div class="bg-white py-3 px-10 ">
            <ul class="flex justify-between">
                <li class="w-[45%]">
                    Item
                </li>
                <li>Price Quotation</li>
                <li>Quantity </li>
                <li>Price</li>
                <li>Action</li>

            </ul>

        </div>
        @foreach ($vendors as $vendor)
            <div class="bg-white py-3 my-3 px-5">
                <h1 class="border-b-2 border-slate-200 py-4">
                    <i class="fa-solid fa-shop"></i>&emsp;{{ $vendor['name'] }}
                </h1>
                <div class="my-5 flex justify-between items-center">
                    @foreach (Cart::getContent() as $cartItem)
                        @php
                            $product = App\Models\Product::findOrFail($cartItem->attributes['product_id']);

                        @endphp
                        @if ($cartItem->attributes['vendor_id'] == $vendor['id'])
                            <div class="w-[50%] flex items-center gap-10">
                                <span class="w-[15%]"><img width="100"
                                        src="{{ asset($cartItem->attributes['imageURL']) }}" /></span>
                                <span class="flex-1">{{ $cartItem->name }}</span>
                                <div class="flex-1">
                                    @foreach ($cartItem->attributes as $key => $item)
                                        @if ($key != 'brand_id' && $key != 'product_id' && $key != 'vendor_id' && $key != 'imageURL')
                                            <span>{{ $item }}</span> </br />
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            $<span class="price-quotation-{{ $cartItem->id }}">{{ $cartItem->price }}</span>
                            <div class="flex">
                                <p data-id="{{ $cartItem->id }}"
                                    class="decrease cursor-pointer border-2 border-slate-200 py-1 px-3">-</p>
                                <input data-id="{{ $cartItem->id }}" value="{{ $cartItem->quantity }}" type="text"
                                    class="quantity-{{ $cartItem->id }} text-center w-[80px] border-x-0 border-y-2 border-slate-200 focus:ring-0 focus:border-slate-200"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" />

                                <p data-id="{{ $cartItem->id }}" data-max="{{ $product->qty }}"
                                    class="increase cursor-pointer border-2 border-slate-200 py-1 px-3">+</p>
                            </div>
                            <span class="text-sky-600">$<span
                                    class="price-sum price-sum-{{ $cartItem->id }}">{{ $cartItem->getPriceSum() }}</span></span>
                            <button class="text-red-500">Delete</button class="text-red-500">
                        @endif
                    @endforeach

                </div>
            </div>
        @endforeach
    </div>
@endsection
@push('scripts')
    <script>
        // Quantity item handle  ---------------------------
        $(document).ready(function() {
            $(".increase").on("click", function() {
                let qty = parseInt($(".quantity").val());
                let max = $(this).data("max");
                console.log(max);
                if (qty + 1 > max) return;
                qty = qty + 1;
                const id = $(this).data("id")
                $("quantity-" + id).val(qty);
                const priceQuotation = parseInt($(".price-quotation-" + id).html());
                $(".price-sum-" + id).html(qty * priceQuotation);
            })
            $(".decrease").on("click", function() {
                let qty = parseInt($(".quantity").val());
                if (qty <= 1) return;
                qty = qty - 1;
                const id = $(this).data("id")
                $("quantity-" + id).val(qty);
                const priceQuotation = parseInt($(".price-quotation-" + id).html());
                $(".price-sum-" + id).html(qty * priceQuotation);
            })
            $(".quantity").on("change", function() {
                const max = $(".increase").data("max");
                let qty = $(this).val();
                console.log(qty);
                if (qty <= 0) qty = 1;
                else if (qty > max) qty = max;
                $(this).val(qty);
                const id = $(this).data("id")
                $("quantity-" + id).val(qty);
                const priceQuotation = parseInt($(".price-quotation-" + id).html());
                $(".price-sum-" + id).html(qty * priceQuotation);
            })
        });
        // Quantity item handle  ---------------------------
    </script>
@endpush
