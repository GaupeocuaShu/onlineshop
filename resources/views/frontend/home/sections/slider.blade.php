<!-- Swiper -->
<div class="swiper w-[100%] h-[100%] mySwiper">
    <div class="swiper-wrapper py-8">
        <div class="swiper-slide"><img class="rounded-xl block w-[100%] h-[400px]  object-cover" src="{{asset("uploads/vip1.jpeg")}}"/></div>
        <div class="swiper-slide"><img class="rounded-xl block w-[100%] h-[400px]  object-cover" src="{{asset("uploads/standard1.jpeg")}}"/></div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
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