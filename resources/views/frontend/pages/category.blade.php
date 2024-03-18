@extends('frontend.layout.master')
@section('content')
    <div class="flex py-8 gap-10">
        <div class="flex flex-col min-w-[200px]">
            <a href="" class="text-xl font-semibold py-4 border-b-2 border-slate-200"><i
                    class="fa-solid fa-list text-base"></i>&ensp; All Category</a>
            <a href="" class="my-2 text-sky-700">{{ $category->name }}</a>
            @foreach ($category->subCategories as $sub)
                <a href="" class="my-2">{{ $sub->name }}</a>
            @endforeach
        </div>
        <div>
            <div class="bg-slate-200 p-4 rounded-lg flex gap-5 text-center mb-7 cursor-pointer">
                @foreach (getAllType() as $type)
                    <span class="bg-white  rounded-sm text-black p-2 min-w-[80px]">
                        <a href="">{{ $type }}</a>
                    </span>
                @endforeach
            </div>
            <div class="grid grid-cols-5 gap-3">
                @foreach ($products as $p)
                    <li
                        class= "bg-slate-200 relative hover:shadow-xl hover:-translate-y-1 transition-all hover:border-cyan-600 flex flex-col justify-between border-2 leading-8  border-slate-100">
                        <img class="min-h-[180px] w-full" src="{{ asset($p->thumb_image) }}" />
                        <div class="absolute w-full flex justify-between">
                            <span class="bg-sky-700 rounded-sm text-white text-sm  py-1 px-2">
                                {{ getProductType($p) }}
                            </span>
                            @if (checkSale($p))
                                <span class="bg-sky-700 rounded-sm text-white text-sm py-1 px-2">
                                    {{ calculateSalePercent($p) . '%' }}
                                </span>
                            @endif
                        </div>
                        <div class=" p-2">
                            <h1>{{ $p->name }}</h1>
                            <p class="flex justify-between items-center">
                                <span class="text-orange-500 font-bold">${{ $p->price }}</span>
                                <span class="text-sm ">30 Sold</span>
                            </p>
                        </div>

                    </li>
                @endforeach
            </div>
        </div>
    </div>
@endsection
