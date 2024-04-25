@extends('frontend.layouts.master')

@section('metas')
    <title> OZ Cleaners | Reset your password for account with us </title>
    <meta name="description" content="Forgetting anything is a human nature and we have developed the system to restore anything related with Oz Cleaners.">
    <meta name="keywords" content="Residential cleaning, Commercial cleaning, Exterior cleaning, Interior cleaning, End of Lease Cleaning, Window cleaning, Solar panel cleaning, Strata Cleaning, High pressure cleaning, After builders cleaning, Renovation cleaning, Gutter cleaning, carpet steam cleaning, oven cleaning, BBQ cleaning, Spring cleaning, Regular house cleaning, Regular office cleaning, roof cleaning, roof painting">
    <link href="https://ozcleaners.com.au/booking_form" rel="canonical">
    <meta name="author" content="Oz Cleaners">
    <meta name="zone" content="Australia">
@endsection

@section('content')
<div class="container my-3 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
