<div class="bg-white p-3 shadow-xl rounded-md">

    <h1 class="text-2xl p-3">CATEGORY</h1>
    <ul class="grid grid-cols-8 py-5 cursor-pointer">
        @foreach ($categories as $cate)
            <li data-url="{{ route('category', $cate->slug) }}"
                class="category hover:shadow-xl hover:-translate-y-1 transition-all hover:border-cyan-600 hover:border-r-2 pb-3 text-center border-2 border-r-0   border-slate-200">
                <img class="mx-auto max-w-[120px]" src="{{ asset($cate->image) }}" alt="{{ $cate->name }}" />
                <h1> {{ $cate->name }}</h1>
            </li>
        @endforeach
    </ul>
</div>


@push('scripts')
    <script>
        $(".category").on("click", function() {
            const url = $(this).data("url");
            window.location.replace(url);
        });
    </script>
@endpush
