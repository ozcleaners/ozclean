@extends('admin.layouts.master')

@section('title', 'Medias')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            @component('components.dropzone')
            @endcomponent
        </div>
    </div>
@endsection
