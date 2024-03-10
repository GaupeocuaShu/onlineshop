<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
     {{-- Jquery UI --}}

     <title>{{ $title ?? 'Home' }}</title></head>
<body>
    <div class="font-sans" >
        {{-- Navbar --}}
        @include('frontend.home.layout.navbar')

        {{-- Sidebar --}}
        @include('frontend.home.layout.sidebar')
    
        <!-- Main Content -->
        <div class=" bg-slate-100"> 
            <div class="main-content w-[1400px] mx-auto">
                @yield('content')
            </div>
        </div>

        {{-- Footer --}}
        @include('frontend.home.layout.footer')

    </div>
    {{-- Jquery UI --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/1027857984.js" crossorigin="anonymous"></script>
    {{-- Swiper --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @stack('scripts')
</body>

</html>