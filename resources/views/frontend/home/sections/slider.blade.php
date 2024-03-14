<!-- Swiper -->
<div class="grid md:grid-cols-4 md:grid-rows-3 my-8 gap-5">
    @foreach ($categoryBanners as $banner)
        <div>
            <a href="#">
                <img class=" rounded-xl h-full" alt="{{ $banner->name }}" src="{{ $banner->banner }}" />
            </a>
        </div>
    @endforeach

    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
        class="row-start-1 row-span-2 md:col-start-2 col-span-2  swiper max-w-full h-full mySwiper">
        <div class="swiper-wrapper max-w-full ">
            @foreach ($sliders as $slider)
                <div class="swiper-slide">
                    <img class=" rounded-xl block md:w-full h-[350px]" src="{{ asset($slider->banner) }}" />
                </div>
            @endforeach
        </div>
        <div class=" swiper-button-next"></div>
        <div class=" swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>

</div>

@push('scripts')
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
@endpush
