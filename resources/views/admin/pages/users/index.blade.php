@extends('admin.layouts.master')

@section('title', 'All User')

@section('content')
<div class="content-wrapper p-0">
    <div class="table-wrapper desktop-view mobile-view">
        <table id="table_id">
            <thead style="position: sticky;top:-1px;">
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Employee No</th>
                    <th>Phone</th>
                    <th>Employee status</th>
                    <th>Role</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            {!! $ButtonSet::delete('user_destroy', $user->id) !!}
                            {!! $ButtonSet::edit('user_edit', $user->id) !!}
                        </td>
                        <td> {{ $user->name }} </td>
                        <td> {{ $user->email }} </td>
                        <td> {{ $user->employee_no }} </td>
                        <td> {{ $user->phone }} </td>
                        <td> {{ $user->employee_status }} </td>
                        <td>
                            @foreach($user->roles as $role) 
                                @php
                                    $warehouseName = $Query::accessModel('Warehouse')::name($role->warehouse_id);
                                    $roleName = $Query::accessModel('Role')::name($role->role_id);
                                @endphp
                                    <span title="{{$warehouseName ?? Null}}" class="badge bg-light text-dark">
                                        {{ $roleName ?? Null }}
                                    </span>
                            @endforeach
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection
