@extends('frontend.layout.mastercart')
@section('content')
    <div class ="py-8 relative min-h-screen">
        {{-- Loading --}}
        <div role="status" class="loading absolute w-full h-full hidden items-center justify-center bg-[#eeeeee7d]">
            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
            <div class=" text-black">&emsp;Loading...</div>
        </div>
        {{-- Loading --}}

        @if (\Cart::getTotalQuantity() > 0)
            <div class="bg-white py-3 px-5 ">
                <ul class="flex justify-between">

                    <li class="w-[45%]">
                        <input type="checkbox" data-select="all" data-total = "{{ $totalQuantity }}" /> &emsp;Product
                    </li>
                    <li>Price Quotation</li>
                    <li>Quantity </li>
                    <li>Price</li>
                    <li>Action</li>

                </ul>

            </div>
            @foreach ($vendors as $vendor)
                <div class="bg-white py-3 my-3 px-5">
                    <h1 class="border-b-2 border-slate-200 py-4">
                        <input type="checkbox" data-select="shop" data-id="{{ $vendor['id'] }}" /> &emsp;<i
                            class="fa-solid fa-shop"></i>&emsp;{{ $vendor['name'] }}
                    </h1>
                    <div class="vendor-items">
                        @foreach (Cart::getContent() as $cartItem)
                            @php
                                $product = App\Models\Product::findOrFail($cartItem->attributes['product_id']);
                            @endphp
                            @if ($cartItem->attributes['vendor_id'] == $vendor['id'])
                                <div class="my-5 flex justify-between items-center pb-3 border-b-2 border-slate-200">
                                    <div class="w-[50%] flex items-center gap-10">
                                        <span class="w-[15%] flex items-center">

                                            <input type="checkbox" data-select="item"
                                                data-quantity="{{ $cartItem->quantity }}"
                                                data-vendorid ="{{ $vendor['id'] }}"
                                                class="vendor-{{ $vendor['id'] }} vendor-item"
                                                data-id="{{ $cartItem->id }}" />

                                            &emsp;
                                            <img width="100"
                                                src="{{ asset($cartItem->attributes['imageURL']) }}" /></span>
                                        <span class="flex-1">{{ $cartItem->name }}</span>
                                        <div class="flex-1">
                                            @foreach ($cartItem->attributes as $key => $item)
                                                @if ($key != 'brand_id' && $key != 'product_id' && $key != 'vendor_id' && $key != 'imageURL')
                                                    <span
                                                        class="capitalize">{{ $key }}:&emsp;{{ $item }}</span>
                                                    </br />
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    <span>$<span
                                            class="price-quotation-{{ $cartItem->id }}">{{ $cartItem->price }}</span></span>
                                    <div class="flex">
                                        <p data-id="{{ $cartItem->id }}"
                                            class="decrease decrease-{{ $cartItem->id }} cursor-pointer border-2 border-slate-200 py-1 px-3">
                                            -</p>
                                        <input data-id="{{ $cartItem->id }}" data-max="{{ $product->qty }}"
                                            value="{{ $cartItem->quantity }}" type="text"
                                            class="quantity quantity-{{ $cartItem->id }} text-center w-[80px] border-x-0 border-y-2 border-slate-200 focus:ring-0 focus:border-slate-200"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" />

                                        <p data-id="{{ $cartItem->id }}" data-max="{{ $product->qty }}"
                                            class="increase increase-{{ $cartItem->id }} cursor-pointer border-2 border-slate-200 py-1 px-3">
                                            +</p>
                                    </div>
                                    <span class="text-sky-600">$<span
                                            class="price-sum price-sum-{{ $cartItem->id }}">{{ $cartItem->getPriceSum() }}</span></span>
                                    <button class="text-red-500 remove remove-{{ $cartItem->id }}"
                                        data-url="{{ route('user.cart.delete', $cartItem->id) }}">Delete</button
                                        class="text-red-500">
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            @endforeach
        @else
            <div class="bg-white flex justify-center flex-col items-center h-[30vh] text-2xl">
                <p>
                    <i class="fa-solid fa-circle-xmark"></i> &ensp;Your Cart Is Empty &ensp;<i
                        class="fa-regular fa-face-sad-tear"></i>
                </p>
                <a class="bg-sky-600 hover:bg-sky-700 hover:-translate-y-1 text-white py-3 px-4 my-5 text-xl rounded-lg "
                    href="/">Go
                    Shopping</a>
            </div>
        @endif
    </div>

    <div class="bg-slate-800 text-white flex justify-between p-5 items-center fixed bottom-0 w-[1200px]">
        <div class="flex items-center">
            <input type="checkbox" data-select="all" />&emsp;
            <label>Select All</label>
        </div>
        <div class="relative w-[300px] h-[50px] ">
            <input type="text" class="p-3 w-full text-black" placeholder="Enter Shuty's Shop Voucher" />&emsp;
            <button class="right-0 top-0  h-full absolute bg-sky-600 px-3 py-3 rounded-sm hover:bg-sky-800">Apply</button>
        </div>
        <div>
            Total (<span class="total-quantity">0</span> item): $<span class="total-price">0</span>&emsp;
            <button class="bg-sky-600 px-10 py-3 rounded-sm hover:bg-sky-800">Check out</button>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            function init() {
                $($("input[type= 'checkbox']")).each(function(i, v) {
                    $(v).prop('checked', false);
                });
            }

            init()
            // Remove Item 
            function removeItem(url, hidden) {
                Swal.fire({
                    title: "You Want To Remove This Item",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            dataType: "JSON",
                            success: function(response) {
                                if (response.status == 'success') {
                                    Swal.fire({
                                        title: "Removed",
                                        icon: "success"
                                    });
                                    const checkboxAll = $(
                                        "input[type ='checkbox'][data-select ='all']");
                                    $(checkboxAll).data("total", response.total);
                                    hidden();
                                    checkOnItem();
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.table(jqXHR)
                            }
                        });
                    }

                });
            }
            // Get Cart Item 
            function getCart(type = null, check = null, itemIDArray = null) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('user.cart.get') }}",
                    data: {
                        type: type,
                        isCheck: check,
                        ids: JSON.stringify(itemIDArray),
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        $(".loading").removeClass("hidden");
                        $(".loading").addClass("flex");
                    },
                    success: function(response) {
                        $(".total-quantity").html(response.quantity);
                        $(".total-price").html(response.total);
                        $(".loading").removeClass("flex");
                        $(".loading").addClass("hidden");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.table(jqXHR);
                        $(".loading").removeClass("flex");
                        $(".loading").addClass("hidden");
                    }
                });
            }
            // Update Cart by sending ajax
            function updateCart(id, quantity) {
                $.ajax({
                    type: "PUT",
                    url: "{{ route('user.cart.update') }}",
                    data: {
                        id: id,
                        quantity: quantity,
                    },

                    dataType: "JSON",
                    beforeSend: function() {
                        $(".loading").removeClass("hidden");
                        $(".loading").addClass("flex");
                    },
                    success: function(response) {
                        if (response.status == 'success') checkOnItem();
                        $(".loading").removeClass("flex");
                        $(".loading").addClass("hidden");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.table(jqXHR);
                        $(".loading").removeClass("flex");
                        $(".loading").addClass("hidden");
                    }
                });
            }
            // Quantity item handle  --------------------------- 
            function changeQuantity(id, type = null, max = null) {
                let qty = parseInt($(".quantity-" + id).val());

                // Type filter
                if (type == 'inc') {
                    if (qty + 1 > max) return null;
                    qty = qty + 1;
                } else if (type == 'dec') {
                    if (qty <= 1) return null;
                    qty = qty - 1;
                } else {
                    if (qty <= 0) qty = 1;
                    else if (qty > max) qty = max;
                }

                $(".quantity-" + id).val(qty);
                const priceQuotation = parseInt($(".price-quotation-" + id).html());
                $(".price-sum-" + id).html(qty * priceQuotation);
                return qty;
            }
            // Quantity item handle  --------------------------- 
            function checkOnItem() {
                let itemIDArray = [];
                let count = 0;
                $($("input[type= 'checkbox'].vendor-item:visible")).each(function(i, v) {
                    if ($(v).prop("checked") == true) {
                        count += $(v).data("quantity");
                        itemIDArray.push($(v).data('id'));
                    }
                });
                const checkboxAll = $("input[type ='checkbox'][data-select ='all']");
                console.log(count + " " + $(checkboxAll).data("total"));
                if (count == $(checkboxAll).data("total")) $(checkboxAll).prop("checked", true);
                else $(checkboxAll).prop("checked", false);
                getCart(null, null, itemIDArray);
            }

            $(".increase").on("click", function() {
                const id = $(this).data("id")
                let max = $(this).data("max");
                const quantity = changeQuantity(id, 'inc', max);
                if (quantity == null) {
                    Swal.fire({
                        icon: "error",
                        text: "This product is limited by quantity",
                    });
                } else updateCart(id, quantity)
            })
            $(".decrease").on("click", function() {
                const id = $(this).data("id")
                const quantity = changeQuantity(id, 'dec');
                if (quantity == null) {
                    const removeBtn = $(".remove-" + id);
                    const url = $(removeBtn).data("url");
                    console.log(url);
                    hidden = () => {
                        $(removeBtn).parent().hide();

                    }
                    removeItem(url, hidden);
                } else updateCart(id, quantity)
            })
            $(".quantity").on("change", function() {
                const id = $(this).data("id")
                const max = $(this).data("max");
                const quantity = changeQuantity(id, null, max);
                updateCart(id, quantity)
            })

            // Remove item 

            $(".remove").on("click", function() {
                const url = $(this).data("url");
                hidden = () => {
                    $(this).parent().hide();
                    const items = $($(this).parents().eq(1).find(
                        "input[data-select = 'item']:visible"));
                    console.log(items.length);
                    if (items.length == 0) $(this).parents().eq(2).hide();

                }
                removeItem(url, hidden);


            })

            $("input[type= 'checkbox']").on("click", function() {
                const type = $(this).data('select');
                const check = $(this).prop("checked");


                if (type == 'all') {
                    $($("input[type= 'checkbox']")).each(function(i, v) {
                        $(v).prop('checked', check);
                    });
                    getCart(type, check);

                } else if (type == 'shop') {
                    const vendorID = $(this).data("id");
                    $($(`input[type= 'checkbox'].vendor-${vendorID}`)).each(function(i, v) {
                        $(v).prop('checked', check);
                    });
                    checkOnItem();

                } else {
                    const vendorID = $(this).data('vendorid');
                    const vendorsParent = $(this).parents(".vendor-items");
                    let flag = true;
                    $($(vendorsParent).find("input[data-select ='item']")).each(function(i, v) {
                        if ($(v).prop("checked") == false) flag = false;
                    });
                    if (flag == true)
                        $(`input[data-select="shop"][data-id="${vendorID}"]`).prop("checked", true);
                    else
                        $(`input[data-select="shop"][data-id="${vendorID}"]`).prop("checked", false);
                    checkOnItem()
                }

            });


        });
    </script>
@endpush
