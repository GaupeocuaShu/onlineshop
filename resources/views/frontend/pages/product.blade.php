@extends('frontend.layout.master')
@section('content')
    <div class="py-10">
        <div class="grid grid-cols-[450px_500px] gap-x-10 bg-white p-5">
            <!-- Swiper -->
            <div class="">
                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                    <div class="swiper-wrapper">
                        @foreach ($product->productImageGalleries as $image)
                            <div class="swiper-slide">
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
                        <span class="text-sm bg-sky-500 text-white p-1">{{ calculateSalePercent($product) }}% Sale</span>
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
                        <div class="flex  my-10 ">
                            <span class="font-light  min-w-[100px] capitalize">{{ $variant->name }}</span>
                            <div class="flex flex-wrap gap-4 ">
                                @foreach ($variant->product_variant_item as $item)
                                    <p class="border-2  text-sm border-slate-200 px-3 py-1 cursor-pointer">
                                        {{ $item->name }} </p>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    <div class="flex  my-10 ">
                        <span class="font-light min-w-[100px] capitalize">Quantity</span>
                        <div class="flex">
                            <p class="cursor-pointer border-2 border-slate-200 py-1 px-3">-</p>
                            <p class="cursor-pointer border-y-2 border-slate-200 py-1 px-5">1</p>
                            <p class="cursor-pointer border-2 border-slate-200 py-1 px-3">+</p>
                        </div>
                    </div>
                    <div class="flex gap-7">
                        <button class="text-white bg-sky-600 text-xl rounded-lg border-sky-800 py-2 px-6"><i
                                class="fa-solid fa-cart-shopping "></i>&ensp;Add To
                            Cart</button>
                        <button class="text-xl rounded-lg bg-sky-700 text-white border-sky-600 py-2 px-6">
                            <i class="fa-solid fa-money-bill-wave"></i>&ensp;Check Out</button>

                    </div>
                    <div class="text-sm my-3">
                        <i class="fa-regular fa-circle-check"></i>&ensp;Free return in 15 days !
                    </div>
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
    </script>
@endpush
