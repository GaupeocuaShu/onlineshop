@php
    $paras = request()->input();
    if (isset($paras['brand_slug'])) {
        $brand_slugs = explode(',', $paras['brand_slug']);
        $brandSlugAsso = [];
        foreach ($brand_slugs as $key => $value) {
            $brandSlugAsso[$value] = 1;
        }
    }
@endphp
@extends('frontend.layout.master')
@section('content')
    <div class="flex py-8 gap-10">

        <div>
            {{-- Category --}}
            <div class="flex flex-col min-w-[200px]">
                <a href="" class="text-xl font-semibold py-4 border-b-2 border-slate-200"><i
                        class="fa-solid fa-list text-base"></i>&ensp; All Category</a>
                @php
                    $paras_2 = $paras;
                    $paras_2['category'] = $category->slug;
                    unset($paras_2['subcategory']);
                @endphp
                @if (!$activeSub)
                    <a href="{{ route('product', $paras_2) }}" class="my-2 text-sky-600"> <i
                            class="fa-solid fa-play text-sm"></i> {{ $category->name }}</a>
                @else
                    <a href="{{ route('product', $paras_2) }}" class="my-2 font-semibold">{{ $category->name }}</a>
                @endif
                {{-- Category --}}

                @foreach ($category->subCategories as $sub)
                    @php
                        $paras_2 = $paras;
                        $paras_2['subcategory'] = $sub->slug;
                    @endphp
                    @if ($sub->slug == $activeSub)
                        <a href="{{ route('product', $paras_2) }}" class="my-2 text-sky-600">
                            <i class="fa-solid fa-play text-sm"></i> {{ $sub->name }}

                        </a>
                    @else
                        <a href="{{ route('product', $paras_2) }}" class="my-2">
                            {{ $sub->name }}
                        </a>
                    @endif
                @endforeach
            </div>
            <div class="flex flex-col min-w-[200px]">
                <a href="" class="text-xl font-semibold py-4 border-b-2 border-slate-200">
                    <i class="fa-solid fa-shuffle"></i>&ensp; Filter</a>
                {{-- Brand --}}
                <div>
                    <h1 class="font-semibold">Brand</h1>
                    <div class="flex flex-col">
                        <form method="GET" action="{{ route('product') }}">
                            @foreach ($paras as $key => $p)
                                @if ($key != 'brand_slug')
                                    <input type="hidden" name="{{ $key }}" value="{{ $p }}" />
                                @endif
                            @endforeach
                            <input type="hidden" class="brand-slug" name="brand_slug" />
                            @foreach ($brands as $br)
                                <div class="flex gap-2 items-center my-3">
                                    <input
                                        {{ isset($brandSlugAsso[$br->slug]) && $brandSlugAsso[$br->slug] == 1 ? 'checked' : '' }}
                                        class="brand-filter" type="checkbox" value="{{ $br->slug }}">
                                    <label>{{ $br->name }}</label>
                                </div>
                            @endforeach
                            <button
                                class="hover:bg-sky-700 filter-btn my-2 rounded-sm bg-sky-600 text-white py-1 px-4">Filter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div>
            {{-- Type  --}}
            <div class=  " bg-slate-200 p-4 rounded-lg flex gap-5 text-center mb-7 cursor-pointer">
                @foreach (getAllType() as $key => $type)
                    @php
                        $paras_2 = $paras;
                        $paras_2['type'] = $key;
                    @endphp
                    <span data-url="{{ route('product', $paras_2) }}"
                        class=" type-filter rounded-sm p-2 min-w-[80px] {{ $key == $activeType ? 'bg-sky-600 text-white' : 'bg-white text-black' }}">
                        <a href="{{ route('product', $paras_2) }}">{{ $type }}</a>
                    </span>
                @endforeach
            </div>
            <div class="grid grid-cols-5 gap-3 z-[1] relative">
                @foreach ($products as $p)
                    <li
                        class= "bg-slate-200 shadow-lg relative hover:shadow-lg hover:shadow-slate-400 hover:-translate-y-1 transition-all hover:border-sky-600 flex flex-col justify-between  leading-8  ">
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

            $(".brand-filter").on("click", function(e) {
                const brands = $(".brand-filter:checked");
                const brandsID = [];
                $.each(brands, function(index, value) {
                    brandsID.push($(value).val());
                });
                $brandsIDStr = brandsID.join(",");
                $(".brand-slug").val($brandsIDStr);
            })
        });
    </script>
@endpush
