
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

{{-- recommend product --}}
@include('frontend.home.sections.recommend-product')
@endsection