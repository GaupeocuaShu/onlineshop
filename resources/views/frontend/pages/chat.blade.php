@php
    $senderID = App\Models\ShopProfile::where('user_id', Auth::user()->id)->first()->id;
@endphp
@extends('frontend.layout.masterchat')
@section('content')
    {{-- Chat Pannel --}}

    <div class="chat-pannel  shadow-2xl bg-white w-[700px]  fixed top-0 h-full   right-0">
        <div class="p-5 flex justify-between border-b-2 border-slate-200">
            <p class="text-sky-600  text-2xl ">Chat</p>
            <button class="close-chat-pannel text-sky-600 cursor-pointer text-xl"><i
                    class="fa-solid fa-circle-chevron-down"></i></button>
        </div>
        <div class="grid grid-cols-[250px_auto] my-3 h-full ">
            {{-- Vendors --}}
            <div class="receivers overflow-y-scroll border-r-2  border-slate-100">
                {{-- Receiver - Vendor --}}
                @foreach ($receivers as $receiver)
                    <div data-id="{{ $receiver->id }}"
                        class="receiver cursor-pointer flex items-center p-2 max-w-[250px] max-h-[100px]   ">
                        <div><img class="rounded-full" width="50" src="{{ asset($receiver->image) }}" />
                        </div>
                        <div class="flex flex-col p-1">
                            <p class="flex justify-between"><span
                                    class="font-semibold text-sm receiver-name">{{ $receiver->name }}</span>
                                <span class="text-xs">4/2/2024</span>
                            </p>
                            <p class="">Lorem, ipsum dolor sit
                            </p>
                        </div>
                    </div>
                @endforeach

            </div>
            {{-- Message --}}
            <div class="message overflow-y-scroll  bg-slate-200 max-h-[550px]  gap-y-3">
                <div class="bg-white p-3 text-xl text-sky-600 cursor-pointer message-receiver-name">
                </div>
                <div class="message-area flex flex-col gap-y-3  p-5">

                </div>
            </div>

        </div>

        <div class="absolute bottom-0 right-0 w-[450px] max-h-[100px]">
            <form action="" class="send-message">
                <input type="hidden" name="sender_id" value="{{ $senderID }}" />
                <input type="hidden" name="receiver_id" />
                <input name="message_content" id="message_content" placeholder="Type Something ....."
                    class="text-sm w-full h-full focus:ring-0 ring-transparent border-none " />


                <div class=" text-end px-4 py-1 border-t-2 border-gray-200 text-sky-600 text-xl"><button><i
                            class="fa-solid fa-paper-plane"></i></button></div>

            </form>

        </div>
    </div>
@endsection
