<div class="bg-black p-5">
    <nav class="flex justify-between text-white w-[1400px] mx-auto items-center">
        <h1 class="text-2xl"> 
            <a href="/">ShuTy's Shop</a>
        </h1>
        <div class="w-[70%] flex items-center">
            <input class="text-black border-none w-[100%]" type="search" placeholder="We have everything"/>
            <button class="px-5 py-[6px] bg-black text-white z-5 translate-x-[-60px]"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        
        <div class="flex items-center  group gap-2 relative">
            @if (Auth::check())
                @php
                    $user = Auth::user();
                @endphp
                @if ($user->image)
                    <img  class="cursor-pointer" alt="avatar" width="50" src="{{asset($user->image)}}"/>  
                @else 
                    <img class="cursor-pointer"  alt="avatar" width="50" src="{{asset("uploads/user-avatar.png")}}"/>  
                @endif
                <h1 class="cursor-pointer text-base">{{$user->name}}</h1>
                <ul class="group-hover:block hidden leading-8 shadow-2xl rounded-lg absolute top-[50px] z-10 bg-slate-100 text-black p-3  w-[180px]">
                    <a href="" class="hover:bg-slate-300 cursor-pointer block rounded-lg p-2" >Manage Account</a >
                    <a href="" class="hover:bg-slate-300 cursor-pointer block rounded-lg p-2" >Historic Order</a >
                    <a href="" class="hover:bg-slate-300 cursor-pointer block rounded-lg p-2" >Favorite Items</a >
                    <form action="{{route("logout")}}" method="POST">
                        @csrf
                        <a 
                            href="{{route('logout')}}"
                            onclick="event.preventDefault();
                            this.closest('form').submit();"
                            class="hover:bg-red-700 hover:text-white block cursor-pointer rounded-lg p-2"
                        >   
                            Logout
                        </a> 
                    </form>
                </ul>
            @else
                <i class="text-3xl fa-regular fa-circle-user"></i>
                <a href="{{route("login")}}" class="group/login relative">
                    Login
                    <p class="absolute duration-300  group-hover/login:duration-300 group-hover/login:w-[105%] w-0 left-[0px] bg-white h-[2px] bottom-[-10px]"></p>
                </a>/
                <a href="{{route("register")}}" class="group/signup relative">
                    Sign Up
                    <p class="absolute duration-300  group-hover/signup:duration-300 group-hover/signup:w-[100%] w-0 left-[0px] bg-white h-[2px] bottom-[-10px]"></p>
                </a>
            @endif
        </div>
        <a>
            <i class="fa-solid fa-cart-shopping"></i>
        </a>
    </nav>

</div>