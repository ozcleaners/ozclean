@extends('frontend.layouts.master')
@section('content')
    <div class="row m-0 justify-content-center">
        <div class="col-lg-7 mt-5">
           <div class="text-center">
               <a href="{{route('frontend_invoice_download', request()->hash_code)}}" class="btn btn-lg  btn-primary my-2">Download Invoice</a>
           </div>
            @include('frontend.user.invoice-website-format')
        </div>

    </div>
@endsection
