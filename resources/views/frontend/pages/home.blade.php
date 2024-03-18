@extends('frontend.layout.master')
@section('content')
    {{-- Slider --}}
    @include('frontend.sections.slider')


    {{-- Category --}}
    @include('frontend.sections.category')

    {{-- Flash sell --}}
    @include('frontend.sections.flash-sell')

    {{-- Brand --}}
    @include('frontend.sections.brand')

    {{-- top product --}}
    @include('frontend.sections.top-product')

    {{-- New Arrival product --}}
    @include('frontend.sections.new-arrival')
@endsection
