@extends('frontend.layout.master')
@section('content')
    <div class="flex py-8 gap-10">

        <div>
            {{-- Category --}}
            <div class="flex flex-col min-w-[200px]">
                <a href="" class="text-xl font-semibold py-4 border-b-2 border-slate-200"><i
                        class="fa-solid fa-list text-base"></i>&ensp; All Category</a>
                @if (!$activeSub)
                    <a href="{{ route('product', ['category' => $category->slug]) }}" class="my-2 text-sky-600"> <i
                            class="fa-solid fa-play text-sm"></i> {{ $category->name }}</a>
                @else
                    <a href="{{ route('product', ['category' => $category->slug]) }}"
                        class="my-2 font-semibold">{{ $category->name }}</a>
                @endif
                @foreach ($category->subCategories as $sub)
                    @if ($sub->slug == $activeSub)
                        <a href="{{ route('product', ['subcategory' => $sub->slug, 'category' => $category->slug, 'type' => $activeType]) }}"
                            class="my-2 text-sky-600">
                            <i class="fa-solid fa-play text-sm"></i> {{ $sub->name }}

                        </a>
                    @else
                        <a href="{{ route('product', ['subcategory' => $sub->slug, 'category' => $category->slug, 'type' => $activeType]) }}"
                            class="my-2">
                            {{ $sub->name }}
                        </a>
                    @endif
                @endforeach
            </div>
            {{-- Brand --}}
            <div class="flex flex-col min-w-[200px]">
                <a href="" class="text-xl font-semibold py-4 border-b-2 border-slate-200">
                    <i class="fa-solid fa-shuffle"></i>&ensp; Filter</a>
                @if (!$activeSub)
                    <a href="{{ route('product', ['category' => $category->slug]) }}" class="my-2 text-sky-600"> <i
                            class="fa-solid fa-play text-sm"></i> {{ $category->name }}</a>
                @else
                    <a href="{{ route('product', ['category' => $category->slug]) }}"
                        class="my-2 font-semibold">{{ $category->name }}</a>
                @endif
                @foreach ($category->subCategories as $sub)
                    @if ($sub->slug == $activeSub)
                        <a href="{{ route('product', ['subcategory' => $sub->slug, 'category' => $category->slug, 'type' => $activeType]) }}"
                            class="my-2 text-sky-600">
                            <i class="fa-solid fa-play text-sm"></i> {{ $sub->name }}

                        </a>
                    @else
                        <a href="{{ route('product', ['subcategory' => $sub->slug, 'category' => $category->slug, 'type' => $activeType]) }}"
                            class="my-2">
                            {{ $sub->name }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
        <div>

            <div class=  " bg-slate-200 p-4 rounded-lg flex gap-5 text-center mb-7 cursor-pointer">
                @foreach (getAllType() as $key => $type)
                    <span data-url="{{ route('product', ['type' => $key, 'category' => $slug]) }}"
                        class=" type-filter rounded-sm p-2 min-w-[80px] {{ $key == $activeType ? 'bg-sky-600 text-white' : 'bg-white text-black' }}">
                        <a href="{{ route('product', ['type' => $key, 'category' => $slug]) }}">{{ $type }}</a>
                    </span>
                @endforeach
            </div>
            <div class="grid grid-cols-5 gap-3 z-[1] relative">
                @foreach ($products as $p)
                    <li
                        class= "bg-slate-200 relative hover:shadow-xl hover:-translate-y-1 transition-all hover:border-sky-600 flex flex-col justify-between border-2 leading-8  border-slate-100">
                        <img class="min-h-[180px] w-full" src="{{ asset($p->thumb_image) }}" />
                        <div class="absolute w-full flex justify-between">
                            <span class="bg-sky-600 rounded-sm text-white text-sm  py-1 px-2">
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


@push('scripts')
    <script>
        $(document).ready(function() {
            $(".type-filter").on("click", function() {
                window.location.replace($(this).data("url"));
            });

        });
    </script>
@endpush
