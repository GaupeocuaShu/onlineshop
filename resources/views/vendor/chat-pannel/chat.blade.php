@extends('vendor.layout.master')
@section('content')
    <section class="section">

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card chat-box card-success" id="mychatbox2">
                        <div class="card-header">
                            <h4><i class="fas fa-circle text-success mr-2" title="Online" data-toggle="tooltip"></i> Chat with
                                Ryan</h4>
                        </div>
                        <div class="card-body chat-content">
                        </div>
                        <div class="card-footer chat-form">
                            <form id="chat-form2">
                                <input type="text" class="form-control" placeholder="Type a message">
                                <button class="btn btn-primary">
                                    <i class="far fa-paper-plane"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Chat -----------------------------------
        const senderId = "{{ Auth::check() ? Auth::user()->id : ' ' }}";

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

        function getMessage(senderId, receiverID) {
            $.ajax({
                type: "GET",
                url: "{{ route('user.message.get-message') }}",
                data: {
                    receiver_id: receiverID
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.status == 'success') {
                        $(".message-area").html('');
                        const chat = response.chat;
                        $.each(chat, function(i, e) {
                            let senderHTML, receiverHTML;
                            if (e.sender_id == senderId) {
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

        // Change Message Receiver
        $(".receiver").on("click", function() {
            const receiverID = $(this).data('id');
            getMessage(senderId, receiverID);
            setInputReceiverID(receiverID);
            init();
            $(this).addClass("bg-slate-100");
            const receiverName = $(this).find(".receiver-name").html();
            $(".message-receiver-name").html(receiverName);
        })
        $(".show-chat-pannel").on("click", function() {

            const name = $(this).data("name");
            const banner = $(this).data("banner");
            const receiverID = $(this).data("id");

            $(".receiver").each(function(i, v) {
                if ($(v).data('id') == receiverID) {
                    init();
                    $(v).addClass("bg-slate-100");
                    getMessage(senderId, receiverID);
                } else {
                    const messagePatternHTML = `
            <div class="message overflow-y-scroll  bg-slate-200 max-h-[550px]  gap-y-3">
                    <div class="bg-white p-3 text-xl text-sky-600 cursor-pointer message-receiver-name">${name}
                    </div>
                    <div class="message-area flex flex-col gap-y-3  p-5">
                        
                    </div>
                </div>
            `
                    $(".message").replaceWith(messagePatternHTML);
                }
            })

            setInputReceiverID(receiverID);

            $(".chat-pannel").show(500);

        });
        $(".close-chat-pannel").on("click", function() {
            $(".chat-pannel").hide(500);
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
            $.ajax({
                type: "POST",
                url: "{{ route('user.message.send-message') }}",
                data: data,
                dataType: "JSON",
                success: function(response) {
                    if (response.status == "success") {
                        const receiver = response.receiver;
                        if (response.isNewConversation) {
                            const receiverHTML = `
                    <div class="receiver cursor-pointer flex items-center p-2 max-w-[250px] max-h-[100px] bg-slate-100  ">
                            <div><img class="rounded-full" width="50"
                                    src="{{ asset('${receiver.banner}') }}" />
                            </div>
                            <div class="flex flex-col p-1">
                                <p class="flex justify-between"><span class="font-semibold text-sm receiver-name">${receiver.name}</span>
                                    <span class='text-xs'>4/2/2024</span>
                                </p>
                                <p class="">Lorem, ipsum dolor sit
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
            console.log(data);
        })
        // Chat -----------------------------------
    </script>
@endpush
