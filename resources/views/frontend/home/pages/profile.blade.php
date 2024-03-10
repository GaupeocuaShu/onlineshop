
@extends('frontend.home.layout.master',['title' => $title])
@section('content')

<div class="py-5">
{{-- Account sidebar --}}
<div id="tabs" class="flex flex-col md:flex-row  gap-6 ">
    <ul class="rounded-xl">
      <li class="w-[280px] active link duration-100 hover:duration-100 hover:font-semibold text-lg h-[60px] bg-white border-b-2 border-slate-200"><a class="w-[100%] block p-5" href="#tabs-1"><i class="fa-solid fa-circle-user"></i>&emsp;Account</a></li>
      <li class="w-[280px] link duration-100 hover:duration-100 hover:font-semibold text-lg h-[60px] bg-white border-b-2 border-slate-200"><a class="w-[100%] block p-5" href="#tabs-2"><i class="fa-solid fa-cart-shopping"></i>&emsp;Historic Order</a></li>
      <li class="w-[280px] link duration-100 hover:duratio100-100 hover:font-semibold text-lg h-[60px] bg-white border-b-2 border-slate-200"><a class="w-[100%] block p-5" href="#tabs-3"><i class="fa-solid fa-lock"></i>&emsp;Password And Security</a></li>
      <li class="w-[280px] link duration-100 hover:duration-100 hover:font-semibold text-lg h-[60px] bg-white border-b-2 border-slate-200"><a class="w-[100%] block p-5" href="#tabs-3"><i class="fa-solid fa-heart"></i>&emsp;Favorite Items</a></li>
    </ul>
    <div class="">
        <div id="tabs-1" class="card bg-white p-8">
            <div>
                {{-- Overview --}}
                <h1 class="text-2xl font-semibold">Overview</h1>
                <div class="my-5 flex flex-col md:flex-row justify-between flex-wrap gap-y-4 "> 
                    <div class="w-[300px]">
                        <h1>Name</h1>
                        <p class="font-semibold">Admin</p>
                    </div>
                    
                    <div class="w-[300px]">
                        <h1>Username</h1>
                        <p class="font-semibold">Admin123</p>
                    </div>
                    <div class="w-[300px]">
                        <h1>Email</h1>
                        <p class="font-semibold">Admin@gmail.com</p>
                    </div>
                    <div class="w-[300px]">
                        <h1>Role</h1>
                        <p class="font-semibold">Member</p>
                    </div>
                    <div class="w-[300px]">
                        <h1>Balance</h1>
                        <p class="font-semibold">0</p>
                    </div>
                    <div class="w-[300px]">
                        <h1>Date Join</h1>
                        <p class="font-semibold">2023-08-17 00:29:46</p>
                    </div>
                </div>
            </div>
            <div class="flex md:flex-row flex-col md:items-center gap-10 my-5 border-t-2 border-b-2 border-slate-200"> 
                <div class="flex items-center gap-3 gap-x-8">
                    <img src="{{asset("uploads/user-avatar.png")}}" alt="avatar" width="200"/>
                    <div >
                        <button class="button-outline">Edit Avatar</button>
                    </div>
                </div>
                <div class="h-[100%] border-l-2 border-slate-200 px-8">
                    <p>Please select Image that have size less than 5KB</p>
                    <p>Do not select offensive image </p>
                </div>
            </div>
            <div class="gap-y-10"> 
                <h1 class="text-2xl font-semibold">Modify Information</h1>
                <div class="mt-5">
                <form class="flex flex-col gap-y-5"> 
                    <input class="md:w-[50%] w-[30%] rounded-lg hover:border-blue-500 border-[2px]"  type="text" name="name" placeholder="Name"/>
                    <input class="md:w-[50%] w-[30%] rounded-lg hover:border-blue-500 border-[2px]"  type="text" name="username" placeholder="Username"/>
                    <input class="md:w-[50%] w-[30%] rounded-lg hover:border-blue-500 border-[2px]"  type="text" name="phone" placeholder="Phone"/>
                    <input class="md:w-[50%] w-[30%] rounded-lg hover:border-blue-500 border-[2px]"  type="text" name="email" placeholder="Email"/>
                    <button class="w-[11%] button-outline">Save Change</button> 
                </form>
            </div>
            </div>
        </div>
          <div id="tabs-2">
            <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
          </div>
          <div id="tabs-3">
            <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
            <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
          </div>
    </div>
  </div>
</div>

   
@endsection
@push("scripts")
  <script>
    $(document).ready(function() {
        $( function() {
            $( "#tabs" ).tabs();
        } );

        $(".link").on("click", function () {
            $('.link').removeClass("active");
            $(this).addClass("active");
        });
    });
    </script>
@endpush