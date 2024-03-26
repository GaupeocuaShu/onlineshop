@php
    if (Auth::check()) {
        Cart::Session(Auth::user()->id);
    }
@endphp
<div class=" bg-slate-800  w-screen z-[100] ">
    <div class=" bg-slate-900 ">
        <div class="md:w-[1200px] text-white p-5 mx-auto hidden md:flex justify-between">
            <p> <i class="fa-solid fa-rectangle-ad"></i> &ensp; <a class="hover:underline hover:underline-offset-4"
                    href="">Best Sweater For Winter</a></p>
            <ul class="flex justify-end gap-x-5">
                <li><i class="fa-solid fa-book"></i>&ensp; <a class="hover:underline hover:underline-offset-4  "
                        href="">How To Buy Our Product?</a></li>
                <li><i class="fa-solid fa-address-book"></i>&ensp;<a class="hover:underline hover:underline-offset-4  "
                        href="">Contact Us</a></li>
            </ul>
        </div>
    </div>
    <div class="md:w-[1200px] p-3 mx-auto">

        <nav class=" flex justify-between md:gap-5 lg:gap-0 lg:justify-between text-white  items-center">
            <h1 class="text-2xl">
                <a href="/" class="hidden md:block">ShuTy's Shop</a>
                <div class="sm:block md:hidden relative">
                    <button class="fa-solid fa-bars show-sidebar"></button>
                    {{-- Phone --}}
                    <div
                        class="hidden text-black sidebar  md:hidden p-5 fixed left-[0px]  top-[0px] z-10 bg-white h-[100vh] w-[300px]">
                        <button
                            class="text-4xl text-red-700 close-sidebar absolute right-3 top-3 fa-regular fa-circle-xmark"></button>
                        @if (Auth::check())
                            @php
                                $user = Auth::user();
                            @endphp
                            <div class="mt-5  flex gap-x-3">
                                @if ($user->image)
                                    <img class="cursor-pointer object-cover" alt="avatar" width="70"
                                        src="{{ asset($user->image) }}" />
                                @else
                                    <img class="cursor-pointer object-cover" alt="avatar" width="70"
                                        src="{{ asset('uploads/user-avatar.png') }}" />
                                @endif

                                <h1 class="cursor-pointer text-xl p-2 overflow-hidden">{{ $user->name }}
                                    {{ $user->email }}</h1>
                            </div>
                            <ul
                                class="mt-5 border-t-2 border-slate-200 group-hover:block text-base gap-y-6   text-black ">
                                <a href="{{ route('user.profile') }}"
                                    class="hover:bg-slate-300 cursor-pointer block rounded-lg p-2">Manage Account</a>
                                <a href=""
                                    class="hover:bg-slate-300 cursor-pointer block rounded-lg p-2">Historic
                                    Order</a>
                                <a href=""
                                    class="hover:bg-slate-300 cursor-pointer block rounded-lg p-2">Favorite
                                    Items</a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        this.closest('form').submit();"
                                        class="hover:bg-red-700 hover:text-white block cursor-pointer rounded-lg p-2">
                                        Logout
                                    </a>
                                </form>
                            </ul>
                        @else
                            <i class="text-3xl fa-regular fa-circle-user"></i>
                            <a href="{{ route('login') }}" class="group/a relative">
                                Login
                                <p
                                    class="absolute duration-300  group-hover/login:duration-300 group-hover/login:w-[105%] w-0 left-[0px] bg-white h-[2px] bottom-[-10px]">
                                </p>
                            </a>/
                            <a href="{{ route('register') }}" class="group/signup relative">
                                Sign Up
                                <p
                                    class="absolute duration-300  group-hover/signup:duration-300 group-hover/signup:w-[100%] w-0 left-[0px] bg-white h-[2px] bottom-[-10px]">
                                </p>
                            </a>
                        @endif
                        <ul class="text-black pt-5 border-slate-300 text-base border-t-2 flex flex-col gap-y-6 mt-5">

                            <li><a href="#" class="hover:underline hover:underline-offset-8"><i
                                        class="fa-solid fa-list"></i>
                                    Category</a>

                            </li>
                            <li><a href="#" class="hover:underline hover:underline-offset-8"><i
                                        class="fa-solid fa-eye"></i>
                                    Recently
                                    Viewd</a></li>
                            <li><a href="#" class="hover:underline hover:underline-offset-8"><i
                                        class="fa-solid fa-fire-flame-curved"></i> Best
                                    Sellers</a></li>
                            <li><a href="#" class="hover:underline hover:underline-offset-8"><i
                                        class="fa-solid fa-percent"></i>
                                    Promotions</a></li>
                            <li><a href="#" class="hover:underline hover:underline-offset-8"><i
                                        class="fa-regular fa-credit-card"></i> Payment
                                    Options</a></li>
                        </ul>
                        <ul class="flex flex-col pt-5 border-slate-300 text-base border-t-2 gap-y-6 mt-5">

                            <li> <i class="fa-solid fa-rectangle-ad"></i> <a
                                    class="hover:underline hover:underline-offset-4" href="">Best Sweater For
                                    Winter</a></li>
                            <li><i class="fa-solid fa-book"></i> <a class="hover:underline hover:underline-offset-4  "
                                    href="">How To Buy Our
                                    Product?</a></li>
                            <li><i class="fa-solid fa-address-book"></i> <a
                                    class="hover:underline hover:underline-offset-4  " href="">Contact Us</a>
                            </li>

                        </ul>
                    </div>
                    {{-- Phone --}}
                </div>
            </h1>
            <div class="md:w-[20%] lg:w-[40%] w-[100%] ml-8 flex items-center">
                <input class="text-black border-none w-[100%] rounded-sm" type="search"
                    placeholder="We have everything" />
                <button class="px-5 py-[6px] bg-slate-700 text-white z-5 translate-x-[-60px]"><i
                        class="fa-solid fa-magnifying-glass"></i></button>
            </div>

            <div class="hidden md:flex  items-center  group gap-2 relative">
                @if (Auth::check())
                    @php
                        $user = Auth::user();
                    @endphp
                    @if ($user->image)
                        <img class=" rounded-full cursor-pointer" alt="avatar" width="50"
                            src="{{ asset($user->image) }}" />
                    @else
                        <img class=" rounded-full cursor-pointer" alt="avatar" width="50"
                            src="{{ asset('uploads/user-avatar.png') }}" />
                    @endif
                    <h1 class="cursor-pointer text-base">{{ $user->name }} / {{ $user->email }}</h1>
                    <ul
                        class="group-hover:block hidden leading-8 shadow-2xl rounded-lg absolute top-[50px] z-10 bg-slate-100 text-black p-3  w-[180px]">
                        <a href="{{ route('user.profile') }}"
                            class="hover:bg-slate-300 cursor-pointer block rounded-lg p-2">Manage Account</a>
                        <a href="" class="hover:bg-slate-300 cursor-pointer block rounded-lg p-2">Historic
                            Order</a>
                        <a href="" class="hover:bg-slate-300 cursor-pointer block rounded-lg p-2">Favorite
                            Items</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                this.closest('form').submit();"
                                class="hover:bg-red-700 hover:text-white block cursor-pointer rounded-lg p-2">
                                Logout
                            </a>
                        </form>
                    </ul>
                @else
                    <i class="text-3xl fa-regular fa-circle-user"></i>
                    <a href="{{ route('login') }}" class="group/login relative">
                        Login
                        <p
                            class="absolute duration-300  group-hover/login:duration-300 group-hover/login:w-[105%] w-0 left-[0px] bg-white h-[2px] bottom-[-10px]">
                        </p>
                    </a>/
                    <a href="{{ route('register') }}" class="group/signup relative">
                        Sign Up
                        <p
                            class="absolute duration-300  group-hover/signup:duration-300 group-hover/signup:w-[100%] w-0 left-[0px] bg-white h-[2px] bottom-[-10px]">
                        </p>
                    </a>
                @endif
            </div>
            <div class="relative group/minicart border-2 border-white py-2 px-4 md:px-6 rounded-lg cursor-pointer">
                <a class="flex items-center gap-x-2" href="{{ route('user.cart') }}">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <p class="hidden md:block">Cart</p>
                    <div class="cart-qty text-black bg-white p-1 border-1 rounded-sm border-black">
                        @if (Auth::check())
                            {{ \Cart::getTotalQuantity() }}
                        @else
                            0
                        @endif
                    </div>
                </a>

                {{-- Cart  --}}
                <div
                    class="absolute z-[100]  rounded-xl group-hover/minicart:block hidden border-2 border-slate-300 shadow-2xl p-3 right-0 top-[50px] bg-white text-black w-[400px]">
                    @if (\Cart::getTotalQuantity() > 0)
                        <div>
                            <h1 class="font-light p-3">New Added Item</h1>
                            <ul class="cart-mini">
                                @if (Auth::check())
                                    @if (!\Cart::isEmpty())
                                        @foreach (\Cart::getContent() as $item)
                                            <li
                                                class="flex hover:bg-slate-100 p-2 justify-between leading-[80px] items-center">
                                                <span class="flex gap-2 items-center">
                                                    <span><img width="50"
                                                            src="{{ asset($item->attributes['imageURL']) }}" /></span>
                                                    <span>{{ $item->name }}</span>
                                                </span>
                                                {{-- |
                                                @foreach ($item->attributes as $key => $v)
                                                    @if ($key != 'imageURL' && $key != 'brand_id' && $key != 'product_id' && $key != 'vendor_id')
                                                        <span>{{ $v }}</span>
                                                    @endif
                                                @endforeach| --}}
                                                <span class="text-sky-600">${{ $item->price }}</span>
                                            </li>
                                        @endforeach
                                    @endif
                                @else
                                    <div class="text-center">Please <a href="{{ route('login') }}"
                                            class="text-sky-600 underline">login</a> to see your
                                        cart</div>
                                @endif

                            </ul>
                        </div>
                    @else
                        <p class="text-center font-thin">
                            <i class="fa-solid fa-circle-xmark"></i> Your Cart Is Empty
                        </p>
                    @endif
                    <div class="pt-5 mt-5 border-t-2 border-slate-200 text-right">
                        <a href="{{ route('user.cart') }}"
                            class="bg-sky-600 rounded-sm hover:bg-sky-700  text-white py-2 px-4">View Cart</a>
                    </div>
                </div>
            </div>

        </nav>
        <ul class="text-white hidden
         md:flex justify-between mt-5">
            <li class="relative group/category "><a href="#"
                    class="hover:underline py-8 pr-[30px] hover:underline-offset-8"><i class="fa-solid fa-list"></i>
                    Category</a>
                {{-- Category --}}
                <ul
                    class=" absolute hidden group-hover/category:block shadow-2xl bg-slate-800   z-[100] top-[50px] w-[280px] leading-10">
                    @foreach ($categories as $cate)
                        <li class="group/subcategory p-3 px-3 text-lg hover:bg-sky-600 relative flex justify-between">
                            <span class="flex items-center w-full">
                                <i class="{{ $cate->icon }}"></i>&ensp;<a
                                    href="{{ route('product', ['category' => $cate->slug]) }}"
                                    class="block w-full">{{ $cate->name }}</a>
                            </span>
                            <span><a href=""><i class="fa-solid fa-caret-right"></i></a></span>
                            {{-- Sub Category --}}
                            <ul
                                class=" absolute hidden group-hover/subcategory:block top-0 left-[280px] shadow-2xl bg-slate-800   z-[100]  w-[350px] leading-10">
                                @foreach ($cate->subCategories as $sub)
                                    <li class=" p-3 px-3 text-lg hover:bg-sky-600  ">
                                        <a href="{{ route('product', ['category' => $cate->slug, 'subcategory' => $sub->slug]) }}"
                                            class="block w-full">{{ $sub->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach

                </ul>
            </li>
            <li><a href="#" class="hover:underline hover:underline-offset-8"><i class="fa-solid fa-eye"></i>
                    Recently
                    View</a></li>
            <li><a href="#" class="hover:underline hover:underline-offset-8"><i
                        class="fa-solid fa-fire-flame-curved"></i> Best
                    Sellers</a></li>
            <li><a href="#" class="hover:underline hover:underline-offset-8"><i
                        class="fa-solid fa-percent"></i>
                    Promotions</a></li>
            <li><a href="#" class="hover:underline hover:underline-offset-8"><i
                        class="fa-regular fa-credit-card"></i> Payment
                    Options</a></li>
        </ul>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $(".show-sidebar,.close-sidebar").on("click", function() {
                $(".sidebar").toggleClass("hidden");
            });

        });
    </script>
@endpush
