@extends('frontend.layout.master', ['title' => $title])
@section('content')

    <div class="py-5">
        {{-- Account sidebar --}}
        <div id="tabs" class="flex flex-col md:flex-row  gap-6 ">
            <ul class="rounded-xl">
                <li data-id="1"
                    class="w-[280px] tab-link-1 tab-link duration-100 hover:duration-100 hover:font-semibold text-lg h-[60px] bg-white border-b-2 border-slate-200">
                    <a class="w-[100%] block p-5" href="#tabs-1"><i class="fa-solid fa-circle-user"></i>&emsp;Account</a></li>
                <li data-id="2"
                    class="w-[280px] tab-link-2 tab-link duration-100 hover:duration-100 hover:font-semibold text-lg h-[60px] bg-white border-b-2 border-slate-200">
                    <a class="w-[100%] block p-5" href="#tabs-2"><i class="fa-solid fa-cart-shopping"></i>&emsp;Historic
                        Order</a></li>
                <li data-id="3"
                    class="w-[280px] tab-link-3 tab-link duration-100 hover:duratio100-100 hover:font-semibold text-lg h-[60px] bg-white border-b-2 border-slate-200">
                    <a class="w-[100%] block p-5" href="#tabs-3"><i class="fa-solid fa-lock"></i>&emsp;Password And
                        Security</a></li>
                <li data-id="4"
                    class="w-[280px] tab-link-4 tab-link duration-100 hover:duration-100 hover:font-semibold text-lg h-[60px] bg-white border-b-2 border-slate-200">
                    <a class="w-[100%] block p-5" href="#tabs-3"><i class="fa-solid fa-heart"></i>&emsp;Favorite Items</a>
                </li>
            </ul>
            <div class="w-[100vw]">
                <div id="tabs-1" class=" bg-white p-8">
                    <div>
                        {{-- Overview --}}
                        <h1 class="text-2xl pb-2 font-semibold border-b-2 border-slate-300">Overview</h1>
                        <div class="my-5 flex flex-col md:flex-row justify-between flex-wrap gap-y-4 ">
                            <div class="md:w-[300px]">
                                <h1>Name</h1>
                                <p class="font-semibold">{{ $user->name }}</p>
                            </div>

                            <div class="w-[300px]">
                                <h1>Username</h1>
                                <p class="font-semibold">{{ $user->username }}</p>
                            </div>
                            <div class="w-[300px]">
                                <h1>Email</h1>
                                <p class="font-semibold">{{ $user->email }}</p>
                            </div>
                            <div class="w-[300px]">
                                <h1>Role</h1>
                                <p class="capitalize font-semibold">{{ $user->role }}</p>
                            </div>
                            <div class="w-[300px]">
                                <h1>Balance</h1>
                                <p class="font-semibold">0</p>
                            </div>
                            <div class="w-[300px]">
                                <h1>Date Join</h1>
                                <p class="font-semibold">{{ $user->created_at }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex md:flex-row flex-col md:items-center gap-10 my-5 border-t-2 border-slate-200">
                        <div class="flex flex-col md:flex-row md:items-center gap-3 gap-x-8">
                            <img class="rounded-full" src="{{ asset($user->image) }}" alt="avatar" width="200" />
                            <form enctype="multipart/form-data" method="POST" action="{{ route('user.update-profile') }}">
                                @csrf
                                <input name="image" type="file" class="file invisible" /></br>
                                <button class="upload-file button-outline">Edit Avatar</button>
                            </form>
                        </div>
                        <div class="md:h-[100%]  border-l-2 border-slate-200 md:px-8">
                            <p>Please select Image that have size less than 5KB</p>
                            <p>Do not select offensive image </p>
                        </div>
                    </div>
                    <div class="gap-y-10">
                        <h1 class="text-2xl pb-2 font-semibold border-b-2 border-slate-300">Modify Information</h1>
                        <div class="mt-5">
                            <form enctype="multipart/form-data" method="POST" action="{{ route('user.update-profile') }}"
                                class="flex flex-col gap-y-5">
                                @csrf
                                <input class="md:w-[50%] w-[100%] rounded-lg hover:border-blue-500 border-[2px]"
                                    type="text" name="name" placeholder="Name" />
                                <input class="md:w-[50%] w-[100%] rounded-lg hover:border-blue-500 border-[2px]"
                                    type="text" name="username" placeholder="Username" />
                                <input class="md:w-[50%] w-[100%] rounded-lg hover:border-blue-500 border-[2px]"
                                    type="text" name="phone" placeholder="Phone" />
                                <input class="md:w-[50%] w-[100%] rounded-lg hover:border-blue-500 border-[2px]"
                                    type="text" name="email" placeholder="Email" />
                                <button class="w-[100%] md:w-[15%] button-outline">Save Change</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="tabs-2">

                    <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id
                        nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros
                        molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula
                        in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis.
                        Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat.
                        Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod
                        felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
                </div>
                <div id="tabs-3" class=" bg-white p-8 h-[100vh]">
                    <div>
                        {{-- Change Password --}}

                        <div class="gap-y-10">
                            <h1 class="text-2xl pb-2 font-semibold border-b-2 border-slate-300">
                                Password & Security <br />
                                <span class="text-base font-normal">For your safety, We recommend you to use a strong
                                    password </span>
                            </h1>
                            <div
                                class="mt-5 flex gap-5 flex-col md:flex-row md:items-center pb-8 border-b-2 border-slate-300">
                                <div class="flex-1">
                                    <form enctype="multipart/form-data" method="POST"
                                        action="{{ route('user.update-password') }}" class="flex flex-col gap-y-5">
                                        @csrf
                                        <label class="font-semibold">Modifying Password</label>
                                        <ul class="text-base ">
                                            @if ($errors->any())
                                                @foreach ($errors->all() as $err)
                                                    <li class="text-red-600">{{ $err }}</li>
                                                @endforeach
                                            @endif
                                            @if (Session::has('status'))
                                                <li class="text-green-600"> {{ session('status') }}!</li>
                                            @endif
                                        </ul>
                                        <input class="md:w-[70%] w-[100%] rounded-lg hover:border-blue-500 border-[2px]"
                                            type="password" name="current_password" placeholder="Current Password" />
                                        <input class="md:w-[70%] w-[100%] rounded-lg hover:border-blue-500 border-[2px]"
                                            type="password" name="password" placeholder="New Password" />
                                        <input class="md:w-[70%] w-[100%] rounded-lg hover:border-blue-500 border-[2px]"
                                            type="password" name="password_confirmation"
                                            placeholder="Confirm New Password" />
                                        <button class="w-[100%] md:w-[25%] button-outline">Save Change</button>
                                    </form>
                                </div>
                                <div class="flex-1 border-l-2 pl-8 border-slate-500 ">
                                    <h1 class="font-semibold">Your New Password</h1>
                                    <p>At least one character and one number</p>
                                    <p>More than 8 characters</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            const tabID = localStorage.getItem("tab");
            $(".tab-link-" + tabID).addClass("active");
            $("#tabs").tabs({
                active: tabID - 1
            });
            console.log(tabID);
            $(".file").on("change", function() {
                $(this).closest("form").submit();
            })

            $(".upload-file ").on("click", function(e) {
                e.preventDefault();
                $(".file").click();
            });

            $(".tab-link").on("click", function() {
                const id = $(this).data("id");

                // Save tab into cookie 
                localStorage.setItem('tab', id);

                $('.tab-link').removeClass("active");
                $(this).addClass("active");
            });

        });
    </script>
@endpush
