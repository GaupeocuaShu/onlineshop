<div class="bg-white p-3 shadow-xl rounded-md mt-5">

    <h1 class="text-2xl p-3">BRAND</h1>
    <ul class="py-5 flex flex-wrap">
        @foreach ($brands as $br)
            <li style="background-image: url('{{ asset($br->logo) }}')"
                class="cursor-pointer bg-cover bg:center hover:border-r-2 hover:shadow-xl hover:-translate-y-1 transition-all hover:border-cyan-600  bg-no-repeat pb-3 w-[20%] h-[130px] text-center border-2 border-r-0 border-collapse border-slate-200">

            </li>
        @endforeach

    </ul>
</div>
