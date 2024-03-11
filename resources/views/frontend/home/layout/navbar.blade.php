<div class="bg-slate-700 p-5">
    <nav class=" flex justify-between md:gap-5 lg:gap-0 lg:justify-between text-white md:w-[1400px] mx-auto items-center">
        <h1 class="text-2xl"> 
            <a href="/" class="hidden md:block">ShuTy's Shop</a>
            <div class="sm:block md:hidden relative">
                <button class="fa-solid fa-bars show-sidebar"></button>
                <div class="hidden text-black sidebar  md:hidden p-5 fixed left-[0px]  top-[0px] z-10 bg-white h-[100vh] w-[300px]"> 
                    <button class="text-4xl text-red-700 close-sidebar absolute right-3 top-3 fa-regular fa-circle-xmark"></button>
                    @if (Auth::check())
                        @php
                            $user = Auth::user();
                        @endphp
                        <div class="mt-5 flex gap-x-3">
                            @if ($user->image)
                            <img  class="cursor-pointer object-cover" alt="avatar" width="70" src="{{asset($user->image)}}"/>  
                            @else 
                                <img class="cursor-pointer object-cover"  alt="avatar" width="70" src="{{asset("uploads/user-avatar.png")}}"/>  
                            @endif
                      
                        <h1 class="cursor-pointer text-xl p-2 overflow-hidden">{{$user->name}}  {{$user->email}}</h1>
                        </div>
                        <ul class="mt-5 group-hover:block text-xl leading-[50px]  text-black ">
                            <a href="{{route("user.profile")}}" class="hover:bg-slate-300 cursor-pointer block rounded-lg p-2" >Manage Account</a >
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
                        <a href="{{route("login")}}" class="group/a relative">
                            Login
                            <p class="absolute duration-300  group-hover/login:duration-300 group-hover/login:w-[105%] w-0 left-[0px] bg-white h-[2px] bottom-[-10px]"></p>
                        </a>/
                        <a href="{{route("register")}}" class="group/signup relative">
                            Sign Up
                            <p class="absolute duration-300  group-hover/signup:duration-300 group-hover/signup:w-[100%] w-0 left-[0px] bg-white h-[2px] bottom-[-10px]"></p>
                        </a>
                    @endif

                </div>
            </div>
        </h1>
        <div class="md:w-[20%] lg:w-[40%] w-[100%] ml-8 flex items-center">
            <input class="text-black border-none w-[100%]" type="search" placeholder="We have everything"/>
            <button class="px-5 py-[6px] bg-slate-700 text-white z-5 translate-x-[-60px]"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        
        <div class="hidden md:flex  items-center  group gap-2 relative">
            @if (Auth::check())
                @php
                    $user = Auth::user();
                @endphp
                @if ($user->image)
                    <img  class=" rounded-full cursor-pointer" alt="avatar" width="50" src="{{asset($user->image)}}"/>  
                @else 
                    <img class=" rounded-full cursor-pointer"  alt="avatar" width="50" src="{{asset("uploads/user-avatar.png")}}"/>  
                @endif
                <h1 class="cursor-pointer text-base">{{$user->name}} / {{$user->email}}</h1>
                <ul class="group-hover:block hidden leading-8 shadow-2xl rounded-lg absolute top-[50px] z-10 bg-slate-100 text-black p-3  w-[180px]">
                    <a href="{{route("user.profile")}}" class="hover:bg-slate-300 cursor-pointer block rounded-lg p-2" >Manage Account</a >
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
        <div class="border-2 border-white py-2 px-4 md:px-6 ">
            <a class="flex items-center gap-x-2">
                <i class="fa-solid fa-cart-shopping"></i>
                <p class="hidden md:block">Cart</p>
                <div class="text-black bg-white p-1 border-2 border-black">0</div>
            </a>
        </div>
    </nav>

</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".show-sidebar,.close-sidebar").on("click", function () {
                $(".sidebar").toggleClass("hidden");
            });
            
        });
    </script>
@endpush