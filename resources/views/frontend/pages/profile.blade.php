@extends('frontend.layout.master', ['title' => $title])
@section('content')

    <div class="py-5 relative h-screen ">
        {{-- Account sidebar --}}
        <div id="tabs" class="flex flex-col md:flex-row   gap-6 ">
            <ul class="rounded-xl">
                <li data-id="1"
                    class="w-[350px] tab-link-1 tab-link duration-100 hover:duration-100 hover:font-semibold text-lg h-[60px] bg-white border-b-2 border-slate-200">
                    <a class="w-[100%] block p-5" href="#tabs-1"><i class="fa-solid fa-circle-user"></i>&emsp;Account</a>
                </li>
                <li data-id="2"
                    class="w-[350px] tab-link-2 tab-link duration-100 hover:duration-100 hover:font-semibold text-lg h-[60px] bg-white border-b-2 border-slate-200">
                    <a class="w-[100%] block p-5" href="#tabs-2"><i
                            class="fa-solid fa-cart-shopping"></i>&emsp;Addresses</a>
                </li>
                <li data-id="3"
                    class="w-[350px] tab-link-3 tab-link duration-100 hover:duratio100-100 hover:font-semibold text-lg h-[60px] bg-white border-b-2 border-slate-200">
                    <a class="w-[100%] block p-5" href="#tabs-3"><i class="fa-solid fa-lock"></i>&emsp;Password And
                        Security</a>
                </li>
                <li data-id="5"
                    class="w-[350px] tab-link-5 tab-link duration-100 hover:duration-100 hover:font-semibold text-lg h-[60px] bg-white border-b-2 border-slate-200">
                    <a class="w-[100%] block p-5" href="#tabs-5"><i class="fa-solid fa-heart"></i>&emsp;Favorite Items</a>
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
                <div id="tabs-2" class="p-5 bg-white">
                    <div class="flex justify-between items-center border-b-2 border-slate-200 pb-5">
                        <span class="text-xl">My Addresses</span>
                        <button class="register-address bg-sky-600 hover:bg-sky-700 rounded-sm py-3 px-5 text-white">+ Add
                            New Address
                        </button>
                    </div>
                    <div class="py-5">
                        <h1 class="text-xl">Address</h1>
                        <div>

                        </div>
                    </div>

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
        {{-- Freeze Screen --}}
        <div class="freeze-screen hidden w-screen h-screen bg-[#3232325a] fixed top-0 left-0"></div>
        {{-- Add New Address --}}
        <div
            class="show-address hidden rounded-lg absolute p-10 shadow-2xl bg-white w-[700px] h-[500px] top-[20%] left-[50%] -translate-y-[50%] -translate-x-[50%]">
            <h1 class="text-xl my-5">New Address</h1>
            <form>
                <div class="flex justify-between gap-5">
                    <input class="flex-1" type="text" placeholder="Full Name" />
                    <input class="flex-1" type="text" placeholder="Phone Number" />
                </div>
                <div class="my-5">
                    <input class="w-full" type="text" placeholder="City-District-Ward" />
                </div>
                <div class="my-5">
                    <input class="w-full" type="text" placeholder="Street Name" />
                </div>
                <div class="my-5">
                    <label>Label As:</label> </br>
                    <select class="my-2 w-full">
                        <option>Home</option>
                        <option>Work</option>
                    </select>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" />&ensp;<label>Set As Default Address</label>
                </div>
                <div class="flex gap-5 justify-end">
                    <button class="hide-address py-2 px-7 bg-slate-200 hover:bg-slate-300 rounded-sm">Cancel</button>
                    <button class="py-2 px-7 hover:bg-sky-700 bg-sky-600 text-white rounded-sm">Submit</button>
                </div>
            </form>
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
            $(".register-address").on("click", function() {
                $(".show-address").toggle();
                $(".freeze-screen").toggle();
            })
            $(".hide-address ").on("click", function(e) {
                e.preventDefault();
                $(".show-address").toggle();
                $(".freeze-screen").toggle();
            });
        });
    </script>
@endpush
