@extends('frontend.home.layout.master')
@section('content')
    {{-- Slider --}}
    @include('frontend.home.sections.slider')


    {{-- Category --}}
    @include('frontend.home.sections.category')

    {{-- Flash sell --}}
    @include('frontend.home.sections.flash-sell')

    {{-- Brand --}}
    @include('frontend.home.sections.brand')

    {{-- top product --}}
    @include('frontend.home.sections.top-product')

    {{-- New Arrival product --}}
    @include('frontend.home.sections.new-arrival')
@endsection
