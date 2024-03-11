<!-- Swiper -->
<div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="my-8 swiper max-w-full h-full mySwiper">
    <div class="swiper-wrapper max-w-full ">
        @foreach ($sliders as $slider)
            <div class="swiper-slide">
                <img class=" rounded-xl block md:w-full h-[400px]" src="{{asset($slider->banner)}}"/>
            </div>
        @endforeach
    </div>
    <div class=" swiper-button-next"></div>
    <div class=" swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
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