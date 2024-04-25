@extends('frontend.layouts.master')
@section('content')
    <div class="row m-0 justify-content-center">
        <div class="col-lg-10 mt-5">
            <div class="row">
                @include('frontend.user.profile_menu')
                <div class="col-lg-10">
                    <form id="logout-form" action="{{ route('frontend_modify_profile', auth()->user()->id) }}"
                          method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <label for="name">Name</label>
                                <input type="text" value="{{ auth()->user()->name ?? NULL }}" name="name"
                                       class="contact-form-wrap-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <label for="email">Email</label>
                                <input type="text" name="email"
                                       class="contact-form-wrap-control"
                                       value="{{ auth()->user()->email ?? NULL }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <label for="phone">Phone</label>
                                <input type="text" value="{{ auth()->user()->phone ?? NULL }}" name="phone"
                                       class="contact-form-wrap-control" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-6 col-md-6">
                                <label for="postcode">Postcode</label>
                                <input type="text" value="{{ auth()->user()->postcode ?? NULL }}" name="postcode"
                                       class="contact-form-wrap-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-md-3">
                                <div class="form-field-wrap">
                                    <button type="submit" class="contact-form-submit-button btn">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
