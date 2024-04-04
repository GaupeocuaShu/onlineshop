<div
    class="open-chat-pannel text-xl  bg-sky-600 text-white fixed bottom-5 right-10 p-3 rounded-md shadow-xl cursor-pointer">
    <div><i class="fa-regular fa-comment"></i> Chat</div>
</div>
{{-- Chat Pannel --}}
<div class="chat-pannel z-[100] hidden shadow-2xl bg-white w-[700px]  fixed top-0 h-full   right-0">
    <div class="p-5 flex justify-between border-b-2 border-slate-200">
        <p class="text-sky-600  text-2xl ">Chat</p>
        <button class="close-chat-pannel text-sky-600 cursor-pointer text-xl"><i
                class="fa-solid fa-circle-chevron-down"></i></button>
    </div>
    <div class="grid grid-cols-[250px_auto] my-3 h-full ">
        {{-- Vendors --}}
        <div class="receivers overflow-y-scroll border-r-2  border-slate-100">
            {{-- Receiver - Vendor --}}
            @foreach (getReceivers() as $receiver)
                <div data-id="{{ $receiver->user_id }}"
                    class="receiver cursor-pointer flex items-center p-2 max-w-[250px] max-h-[100px]   ">
                    <div><img class="rounded-full" width="50" src="{{ asset($receiver->banner) }}" />
                    </div>
                    <div class="flex flex-col p-1">
                        <p class="flex justify-between"><span
                                class="font-semibold text-sm receiver-name">{{ $receiver->name }}</span>
                            <span class="text-xs">4/2/2024</span>
                        </p>
                        <p class="">Lorem ipsum dolor sit,
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
            <input type="hidden" name="sender_id" value="{{ Auth::user()->id }}" />
            <input type="hidden" name="receiver_id" />
            <input name="message_content" id="message_content" placeholder="Type Something ....."
                class="text-sm w-full h-full focus:ring-0 ring-transparent border-none " />


            <div class=" text-end px-4 py-1 border-t-2 border-gray-200 text-sky-600 text-xl"><button><i
                        class="fa-solid fa-paper-plane"></i></button></div>
        </form>
    </div>
</div>


@push('scripts')
    <script>
        // Chat -----------------------------------
        const senderId = "{{ Auth::check() ? auth()->user()->id : ' ' }}";

        function init() {
            $(".receiver").each(function(i, v) {
                $(v).removeClass("bg-slate-100");
            });
        }
        init();

        function setInputReceiverID(id) {
            $("input[name = 'receiver_id']").val(id);
        }

        function getCurrentTime(date) {
            var currentTime = new Date(date);

            return currentTime.toLocaleTimeString([], {
                hour: "2-digit",
                minute: "2-digit"
            })
        }
        // Get message
        function getMessage(senderID, receiverID) {
            $.ajax({
                type: "GET",
                url: "{{ route('user.message.get-message') }}",
                data: {
                    receiver_id: receiverID,
                    sender_id: senderID,
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.status == 'success') {
                        $(".message-area").html('');
                        const chat = response.chat;
                        $.each(chat, function(i, e) {
                            let senderHTML, receiverHTML;
                            if (e.sender_id == senderID) {
                                senderHTML = `
                                <div class="sender flex items-end flex-col gap-y-3">
                                    <div class=" bg-sky-600 text-white p-2 max-w-[70%] text-sm rounded-md ">
                                        <p class="message-content">${e.message}</p>
                                        <p class="text-end message-time text-xs font-light">${getCurrentTime(e.created_at)}</p>
                                    </div>
                                </div>  `;
                                $(".message-area").append(senderHTML);
                            } else {
                                receiverHTML = `
                                <div class="receiver flex items-start flex-col gap-y-3">
                                    <div class="bg-white text-black p-2 max-w-[70%] text-sm rounded-md">
                                        <p class="message-content">${e.message}</p>
                                        <p class="text-end message-time text-xs font-light">${getCurrentTime(e.created_at)}</p>
                                    </div>
                                </div>  `
                                $(".message-area").append(receiverHTML);
                            }

                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.table(jqXHR)
                },
                complete: function() {

                }
            });
        }
        // Send Message 
        function sendMessage(data) {
            $.ajax({
                type: "POST",
                url: "{{ route('user.message.send-message') }}",
                data: data,
                dataType: "JSON",
                success: function(response) {
                    if (response.status == "success") {
                        if (response.isNewConversation) {
                            const receiver = response.receiver;
                            const receiverHTML = `
                            <div data-id="${receiver.id}" class="receiver cursor-pointer flex items-center p-2 max-w-[250px] max-h-[100px] bg-slate-100  ">
                                    <div><img class="rounded-full" width="50"
                                            src="{{ asset('${receiver.banner}') }}" />
                                    </div>
                                    <div class="flex flex-col p-1">
                                        <p class="flex justify-between"><span class="font-semibold text-sm receiver-name">${receiver.name}</span>
                                            <span class='text-xs'>4/2/2024</span>
                                        </p>
                                        <p class="last-chat">Lorem, ipsum dolor sit
                                        </p>
                                    </div>
                            </div>
                        `
                            init();
                            $(".receivers").prepend(receiverHTML);
                        }
                        $("#message_content").val("");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.table(jqXHR)
                },
                complete: function() {
                    console.log(12);
                }
            });
        }
        // Change Message Receiver
        $("body").on("click", ".receiver", function() {
            const receiverID = $(this).data('id');
            getMessage(senderId, receiverID);
            setInputReceiverID(receiverID);
            init();
            $(this).addClass("bg-slate-100");
            const receiverName = $(this).find(".receiver-name").html();
            $(".message-receiver-name").html(receiverName);
        })
        // $(".show-chat-pannel").on("click", function() {

        //     const name = $(this).data("name");
        //     const banner = $(this).data("banner");
        //     const receiverID = $(this).data("id");

        //     $(".receiver").each(function(i, v) {
        //         if ($(v).data('id') == receiverID) {
        //             init();
        //             $(v).addClass("bg-slate-100");
        //             getMessage(senderId, receiverID);
        //         } else {
        //             const messagePatternHTML = `
    //         <div class="message overflow-y-scroll  bg-slate-200 max-h-[550px]  gap-y-3">
    //                 <div class="bg-white p-3 text-xl text-sky-600 cursor-pointer message-receiver-name">${name}
    //                 </div>
    //                 <div class="message-area flex flex-col gap-y-3  p-5">

    //                 </div>
    //             </div>
    //         `
        //             $(".message").replaceWith(messagePatternHTML);
        //         }
        //     })

        //     setInputReceiverID(receiverID);

        //     $(".chat-pannel").show(500);

        // });
        $(".close-chat-pannel").on("click", function() {
            $(".chat-pannel").hide(500);
        });

        $(".open-chat-pannel").on("click", function() {
            $(".chat-pannel").show(500);
        });
        $(".send-message").on("submit", function(e) {
            e.preventDefault();
            const data = $(this).serialize();
            const messageContent = $("#message_content").val();
            const currentTime = getCurrentTime(new Date());
            const messageAreaHTML = `
                <div class="sender flex items-end flex-col gap-y-3">
                        <div class=" bg-sky-600 text-white p-2 max-w-[70%] text-sm rounded-md ">
                                <p class="message-content">${messageContent}</p>
                                <p class="text-end message-time text-xs">${currentTime}</p>
                        </div>
                </div>
            `
            $(".message-area").append(messageAreaHTML);
            sendMessage(data);
            $("#message_content").val("");

        })
        // Chat -----------------------------------
    </script>
@endpush
