@extends('frontend.layouts.app')
@section('content')



@include('frontend.components.search')
@include('frontend.components.top-rated-gyms')
@include('frontend.components.partner-benefits')

    
@include('frontend.components.customer-review')

@include('frontend.components.about')

@include('frontend.components.our-customer')



@endsection