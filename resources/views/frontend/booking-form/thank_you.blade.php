@extends('frontend.layouts.master')
@section('content')
    <div class="container">
        <div class="alert alert-success my-3">
           @if(Session::get('message'))
            {!! Session::get('message') !!}
           @else
            The payment has been received. Please check your email for tracking information on your order.
           @endif
        </div>
    </div>
@endsection
