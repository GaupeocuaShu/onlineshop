<div class="bg-black p-5">
    <nav class="flex justify-between text-white w-[1400px] mx-auto items-center">
        <h1 class="text-2xl"> 
            OnlineShop
        </h1>
        <div class="w-[70%] flex items-center">
            <input class="text-black border-none w-[100%]" type="search" placeholder="We have everything"/>
            <button class="px-5 py-[6px] bg-black text-white z-5 translate-x-[-60px]"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        <div class="flex items-center gap-2">
            <i class="text-3xl fa-regular fa-circle-user"></i>
            <a href="{{route("login")}}">Login</a>/
            <a href="{{route("register")}}">Sign Up</a>
        </div>
        <a>
            <i class="fa-solid fa-cart-shopping"></i>
        </a>
    </nav>

</div>