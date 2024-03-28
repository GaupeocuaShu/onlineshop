<div class="bg-white p-3 shadow-xl rounded-md my-5">

    <h1 class="text-2xl p-2">TOP PRODUCT</h1>
    <ul class="grid  grid-cols-6 py-5 gap-5 ccursor-pointer ">
        @foreach ($bestProducts as $t)
            <li data-url="{{ route('product', ['product' => $t->slug]) }}"
                class= " product cursor-pointer shadow-lg relative hover:shadow-lg hover:shadow-slate-400 hover:-translate-y-1 transition-all  flex flex-col justify-between  leading-6  ">
                <img class="min-h-[180px] w-full" src="{{ asset($t->thumb_image) }}" />
                <div class="absolute w-full text-xs flex justify-between">
                    <span class="bg-sky-600 rounded-sm text-white  p-1 ">
                        {{ getProductType($t) }}
                    </span>
                    @if (checkSale($t))
                        <span class="bg-sky-700 rounded-sm text-white p-1 ">
                            {{ calculateSalePercent($t) . '%' }}
                        </span>
                    @endif
                </div>
                <div class=" p-2">
                    <h1>{{ $t->name }}</h1>
                    <p class="flex justify-between items-center mt-3">
                        <span class="text-orange-500 font-bold">${{ $t->price }}</span>
                        <span class="text-sm ">30 Sold</span>
                    </p>
                </div>

            </li>
        @endforeach
    </ul>
</div>


@push('scripts')
    <script>
        $(".product").on("click", function() {
            const url = $(this).data("url");
            window.location.replace(url);
        });
    </script>
@endpush
