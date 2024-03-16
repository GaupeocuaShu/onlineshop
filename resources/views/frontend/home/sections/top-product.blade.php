<div class="bg-white p-3 shadow-xl rounded-md my-5">

    <h1 class="text-2xl p-2">TOP PRODUCT</h1>
    <ul class="grid  grid-cols-6 py-5 gap-3 cursor-pointer ">
        @foreach ($topProducts as $t)
            <li
                class="hover:shadow-xl hover:-translate-y-1 transition-all hover:border-cyan-600 flex flex-col justify-between border-2 leading-8  border-slate-100">
                <img class="min-h-[180px] w-full" src="{{ asset($t->thumb_image) }}" />
                <div class="p-2">
                    <h1>{{ $t->name }}</h1>
                    <p class="flex justify-between items-center">
                        <span class="text-orange-500 font-bold">${{ $t->price }}</span>
                        <span class="text-sm ">30 Sold</span>
                    </p>
                </div>
            </li>
        @endforeach
    </ul>
</div>
