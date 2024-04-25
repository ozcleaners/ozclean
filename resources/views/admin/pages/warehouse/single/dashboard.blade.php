@extends('admin.layouts.master')

@section('title')
Dashboard of {{request()->get('warehouse_name') ?? null}}

@endsection

@section('content')
<div class="content-wrapper">
    @php
        echo request()->get('warehouse_name') ?? null;
    @endphp
</div>
@endsection