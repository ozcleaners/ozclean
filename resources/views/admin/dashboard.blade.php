@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="content-wrapper p-0">
        Dashboard
        @php
            $terms = \App\Models\Term::serviceCat();
            //$terms = DB::table('term');
            //dump($terms);
        @endphp
    </div>
@endsection
