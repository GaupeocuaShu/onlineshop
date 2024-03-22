@extends('frontend.layout.master')
@section('content')
    <div class="py-10">
        <div class="grid grid-cols-[450px_500px] gap-x-10 bg-white p-5">
            <!-- Swiper -->
            <div class="">
                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                    <div class="swiper-wrapper">
                        @foreach ($product->productImageGalleries as $image)
                            <div class="swiper-slide " data-name="{{ $image->name }}">
                                <img src="{{ $image->image }}" />
                            </div>
                        @endforeach

                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <div thumbsSlider="" class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach ($product->productImageGalleries as $image)
                            <div class="swiper-slide">
                                <img src="{{ $image->image }}" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Information -->
            <div>
                <h1 class="text-2xl">{{ $product->name }}</h1>
                <div class="rounded-lg text-3xl text-sky-600 my-4 flex items-center gap-3 bg-slate-200 p-4">
                    @if (checkSale($product))
                        <span class="text-slate-400 text-xl line-through">
                            ${{ $product->price }}</span>${{ $product->offer_price }}
                        <span class="text-sm bg-sky-500 text-white p-1">{{ calculateSalePercent($product) }}%
                            Sale</span>
                    @else
                        ${{ $product->price }}
                    @endif
                </div>
                <div class="">
                    <div class="flex my-10">
                        <span class="font-light min-w-[100px]">Deliver</span>
                        <span>
                            <span class="font-light"><i class="fa-solid fa-truck"></i> Deliver to &ensp;</span> 6320
                            Creekbend Drive<br />
                            <span class="font-light"> Shipping Fee &ensp;</span> $0
                        </span>

                    </div>
                    @foreach ($product->productVariants as $variant)
                        @if ($variant->status == 1)
                            <div class="flex  my-10 ">
                                <span class="font-light  min-w-[100px] capitalize">{{ $variant->name }}</span>
                                <div class="flex flex-wrap gap-4 ">
                                    @foreach ($variant->product_variant_item as $item)
                                        @if ($item->status == 1)
                                            <p data-isswipe={{ $variant->is_swipe }} data-variantid="{{ $variant->id }}"
                                                data-name="{{ $item->name }}"
                                                class="variant-{{ $variant->id }} variant-item-button border-2  text-sm border-slate-200 px-3 py-1 cursor-pointer">
                                                {{ $item->name }} </p>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <div class="flex  my-10 items-center">
                        <span class="font-light min-w-[100px] capitalize">Quantity</span>
                        <div class="flex">
                            <p class="decrease cursor-pointer border-2 border-slate-200 py-1 px-3">-</p>
                            <input value="1" type="text"
                                class="quantity text-center w-[80px] border-x-0 border-y-2 border-slate-200 focus:ring-0 focus:border-slate-200"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" />

                            <p data-max="{{ $product->qty }}"
                                class="increase cursor-pointer border-2 border-slate-200 py-1 px-3">+</p>
                        </div>
                        <p class="text-sm font-light">&emsp;{{ $product->qty }} is Available</p>
                    </div>
                    <div class="flex gap-7">
                        <button
                            class="hover:bg-white hover:text-sky-600 border-2 hover:border-sky-600 transition-all text-white bg-sky-600 text-xl rounded-sm border-sky-600 py-2 px-6"><i
                                class="fa-solid fa-cart-shopping "></i>&ensp;Add To
                            Cart</button>
                        <button
                            class="hover:bg-sky-600 transition-all hover:text-white text-xl rounded-sm text-sky-600 border-2 border-sky-600 py-2 px-6">
                            <i class="fa-solid fa-money-bill-wave"></i>&ensp;Check Out</button>

                    </div>
                    <div class="text-sm my-3">
                        <i class="fa-regular fa-circle-check"></i>&ensp;Free return in 15 days !
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-5 my-7 flex items-center gap-5">

            <div class="flex items-center gap-5">
                <div><img src="{{ asset($shop->banner) }}" width="100" /></div>
                <div class="flex flex-col justify-between border-r-2 pr-5 border-slate-200">
                    <span class="text-2xl">{{ $shop->name }}</span>
                    <span class="text-sm">Online 2 hours ago</span>
                    <span class="my-3 flex">
                        <button class="text-sky-600 border-sky-600 border-2 w-[150px] py-1 px-3"><i
                                class="fa-brands fa-rocketchat"></i>&ensp;Chat</button>&ensp;
                        <button class="text-sky-600 border-sky-600 border-2 w-[150px] py-1 px-3"><i
                                class="fa-solid fa-shop"></i>&ensp;View Shop</button>
                    </span>

                </div>
            </div>
            <div class="grid grid-cols-3 gap-x-10 gap-y-5 ">
                <div>
                    <span>Vote</span> &emsp;
                    <span class="text-sky-600">94K</span>
                </div>
                <div>
                    <span>Feedback Rate</span>&emsp;
                    <span class="text-sky-600">85%</span>
                </div>
                <div>
                    <span>Join</span>&emsp;
                    <span class="text-sky-600">5 Years ago</span>
                </div>
                <div>
                    <span>Products</span>&emsp;
                    <span class="text-sky-600">94</span>
                </div>
                <div>
                    <span>Response Time</span>&emsp;
                    <span class="text-sky-600">In hours</span>
                </div>
                <div>
                    <span>Follower</span>&emsp;
                    <span class="text-sky-600">100K</span>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/product-detail/slider.css') }}">
@endpush
@push('scripts')
    <!-- Swiper JS
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });

        var swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
        // Move slide 
        function moveToSlide(name) {
            var slides = $('.swiper-slide');
            slides.each(function(index) {
                if ($(this).data('name').toLowerCase() === name.toLowerCase()) {
                    swiper2.slideTo(index);
                    return false; // Exit the loop once the slide is found
                }
            });
        }
        // Variant item handle 
        $(".variant-item-button").on("click", function() {
            // Move slide 
            if ($(this).data("isswipe")) {
                const name = $(this).data("name");
                moveToSlide(name)
            }
            // Handle active
            const variantId = $(this).data("variantid");
            $(".variant-" + variantId).removeClass("border-sky-600");
            $(this).addClass("border-sky-600");
        });
        // Quantity item handle  
        $(".increase").on("click", function() {
            let qty = parseInt($(".quantity").val());
            let max = $(this).data("max");
            console.log(max);
            if (qty + 1 > max) return;
            qty = qty + 1;
            $(".quantity").val(qty);
        })
        $(".decrease").on("click", function() {
            let qty = parseInt($(".quantity").val());
            if (qty <= 1) return;
            qty = qty - 1;
            $(".quantity").val(qty);
        })
        $(".quantity").on("change", function() {
            const max = $(".increase").data("max");
            let value = $(this).val();
            console.log(value);
            if (value <= 0) value = 1;
            else if (value > max) value = max;
            $(this).val(value);
        })
    </script>
@endpush
