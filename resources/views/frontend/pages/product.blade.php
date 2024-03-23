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
                                <img data-imageurl ="{{ $image->image }}" src="{{ $image->image }}" />
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
                            ${{ $product->price }}</span> <span class="price">${{ $product->offer_price }}</span>
                        <span class="text-sm bg-sky-500 text-white p-1">{{ calculateSalePercent($product) }}%
                            Sale</span>
                    @else
                        <span class="price"> ${{ $product->price }}</span>
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
                                            <p data-price="{{ $item->price }}" data-isswipe={{ $variant->is_swipe }}
                                                data-variantid="{{ $variant->id }}" data-name="{{ $item->name }}"
                                                data-id = "{{ $item->id }}"
                                                class="variant-{{ $variant->id }} variant-item-button border-2  text-sm  px-3 py-2 cursor-pointer">
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
                        <form>
                            <input type="hidden" name="temp_id" value="{{ $product->id }}" />
                            <input type="hidden" name="id" />
                            <input type="hidden" name="name" value="{{ $product->name }}" />
                            <input type="hidden" name="price"
                                value="{{ checkSale($product) ? $product->offer_price : $product->price }}" />
                            <input type="hidden" name="quantity" value="1" />
                            <input type="hidden" name="attributes[]" />
                            <button
                                class="add-to-cart hover:bg-white hover:text-sky-600 border-2 hover:border-sky-600 transition-all text-white bg-sky-600 text-xl rounded-sm border-sky-600 py-2 px-6"><i
                                    class="fa-solid fa-cart-shopping "></i>&ensp;Add To
                                Cart</button>
                            <button
                                class="hover:bg-sky-600 transition-all hover:text-white text-xl rounded-sm text-sky-600 border-2 border-sky-600 py-2 px-6">
                                <i class="fa-solid fa-money-bill-wave"></i>&ensp;Check Out</button>
                        </form>

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

        <div class="bg-white p-5 my-7  gap-5">
            <div>
                <div class="bg-slate-100 p-3 font-semibold text-lg">PRODUCT DETAIL</div>
                <div class="my-10 leading-10 p-3">
                    <div class="flex gap-16">
                        <span class="font-light min-w-[100px]">Category</span>
                        <span>{{ $product->category->name }} - {{ $product->subCategory->name }}</span>
                    </div>
                    <div class="flex gap-16">
                        <span class="font-light min-w-[100px]">Quantity</span>
                        <span>{{ $product->qty }}</span>
                    </div>
                    <div class="flex gap-16">
                        <span class="font-light min-w-[100px]">Brand</span>
                        <span>{{ $product->brand->name }}</span>
                    </div>
                </div>
            </div>
            <div>
                <div class="bg-slate-100 p-3 font-semibold text-lg">PRODUCT DESCRIPTION</div>
                <div class="my-10 leading-10 p-3">
                    <div class="gap-16">
                        {!! $product->short_description !!}
                    </div>
                    <div class="gap-16">
                        {!! $product->long_description !!}
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
        // Variant item handle --------------------------
        $(".variant-item-button").on("click", function() {
            const variantId = $(this).data("variantid");
            let allVarNames = [];

            // Move slide and handle input image 
            if ($(this).data("isswipe")) {
                const name = $(this).data("name");
                moveToSlide(name);
            }
            var activeIndex = swiper2.activeIndex;
            var activeSlide = swiper2.slides[activeIndex];
            var activeImage = $(activeSlide).find('img');
            const imageURL = $(activeImage).data("imageurl");
            allVarNames.push(imageURL);
            // Add variant Price
            if ($(this).data("price") > 0) {
                let price = parseInt($(".price").html());
                price += parseInt((this).data("price"));
                $(".price").html(price);
                $("input[name='price']").val(price);
            }


            // Handle active
            $(".variant-" + variantId).removeClass("act border-sky-600");
            $(this).addClass("act border-sky-600");

            // Handle input id and input variants 

            const id = $('input[name="temp_id"]').val();
            let newid = id;
            $(".variant-item-button.act").each(function(i, v) {
                newid += $(v).data("id");
                $('input[name="id"]').val(newid);
                allVarNames.push($(v).data("name"))
            });
            $('input[name="attributes[]"]').val(allVarNames);
            console.log(newid);

        });
        // Variant item handle --------------------------

        // Quantity item handle  ---------------------------
        $(".increase").on("click", function() {
            let qty = parseInt($(".quantity").val());
            let max = $(this).data("max");
            console.log(max);
            if (qty + 1 > max) return;
            qty = qty + 1;
            $(".quantity").val(qty);
            $("input[name='quantity']").val(qty);
        })
        $(".decrease").on("click", function() {
            let qty = parseInt($(".quantity").val());
            if (qty <= 1) return;
            qty = qty - 1;
            $(".quantity").val(qty);
            $("input[name='quantity']").val(qty);

        })
        $(".quantity").on("change", function() {
            const max = $(".increase").data("max");
            let qty = $(this).val();
            console.log(qty);
            if (qty <= 0) qty = 1;
            else if (qty > max) qty = max;
            $(this).val(qty);
            $("input[name='quantity']").val(qty);

        })
        // Quantity item handle  ---------------------------

        // Add to cart 
        $(".add-to-cart").on("click", function(e) {
            e.preventDefault();
            const data = $(this).closest("form").serialize();
            // Send form by ajax 
            $.ajax({
                type: "POST",
                url: "{{ route('add-to-cart') }}",
                data: data,
                dataType: "JSON",
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            icon: "success",
                            text: response.message,
                        });
                        $(".cart-qty").html(response.cart);

                        // Append new item to mini cart 
                        if (response.isShowInMiniCart) {
                            let variantsHTML = '';
                            $.each(response.variants, function(i, v) {
                                if (i != 0) variantsHTML += `  <span>${v}</span>`
                            });
                            const li = `
                                <li class="flex hover:bg-slate-100 p-2 justify-between leading-[80px] items-center">
                                    <span class="flex gap-2">
                                        <span><img width="50" src="${response.variants[0]}" /></span>
                                        <span>${ response.name }</span>
                                    </span>|${variantsHTML}|
                                    <span class="text-sky-600">$${response.price }</span>
                                </li>
                        `
                            $(".cart-mini").append(li);
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.table(jqXHR)
                }
            });
        });
    </script>
@endpush
