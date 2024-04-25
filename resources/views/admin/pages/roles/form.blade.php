@extends('admin.layouts.master')

@section('title')

    {{ !empty($role) ? 'Edit role' : 'Add new role' }}

@endsection

@section('content')

    <div class="content-wrapper">
        <form action="{{ !empty($role) ? route('role_update') : route('role_store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-8 col-lg-4 col-sm-12">
                    <div class="card mb-3">
                        <h6>
                            <div class="title-with-border ps-3">
                                Route Information
                            </div>
                        </h6>
                        <div class="card-body">
                            @if (!empty($role))
                                <input type="hidden" name="id" value="{{ $role->id }}">
                            @endif
                            <div class="form-content">

                                <div class="form-group name">
                                    <label for="name">Name: </label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter Name"
                                           name="name"
                                           value="{{ !empty($role) ? $role->name : old('name') }}" required>
                                </div>

                                <div class="form-group select arrow_class">
                                    <label for="select">Role type </label>
                                    @php
                                        $role_type = [
                                            'Global' => 'Global',
                                            'General' => 'General',
                                            'Custom' => 'Custom',
                                        ];
                                    @endphp
                                    <select class="form-select" name="type">
                                        <option>Select role type</option>
                                        @foreach ($role_type as $index => $data)
                                            <option value="{{ $index }}"
                                                {{ !empty($role) && $role->type == $index ? 'selected' : '' }}>
                                                {{ $data }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer form-submit_btn">
                            <input type="submit" class="btn blue" value="Submit"/>
                        </div>
                    </div>
                </div>

                <div class="col-md-1 col-lg-1 col-sm-12"></div>

                <div class="col-md-8 col-lg-7 col-sm-12">
                    <div class="card">
                        <h6>
                            <div class="title-with-border ps-3">
                                Route Permission
                                <div class="d-inline-block float-end valign-text-bottom me-2">
                                    <input type="checkbox" class="" id="checkAll">
                                    <label for="checkAll" class="valign-super">Check All</label>
                                </div>
                            </div>
                        </h6>
                        <div class="card-body">
                            @php
                                $routeList = $Query::getData('route_lists')->groupBy('route_group');
                            @endphp
                            <div class="row">
                                @foreach ($routeList as $index => $item)
                                    <div class="col-md-3">
                                        <div class="xform-group">
                                            <div class="form-check">
                                                <p class="mb-1 fw-bold">
                                                    {{$Query::accessModel('Routegroup')::name($index) }}
                                                </p>
                                                @foreach ($item as $key => $data)
                                                    @php
                                                        $checkId = \App\Models\Routelistrole::checkRouteRole($role->id ?? null, $data->id);

                                                        $routeid = $checkId->route_id ?? null;
                                                    @endphp
                                                    <div class="form-group">
                                                        <input type="checkbox" id="{{ $data->route_name }}"
                                                               class="checkItem"
                                                               {{ $routeid == $data->id ? 'checked' : '' }} name="route_id[]"
                                                               value="{{ $data->id }}">
                                                        <label class="w-100"
                                                               for="{{ $data->route_name }}">{{ $data->route_title }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

@endsection
