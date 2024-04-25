@extends('admin.layouts.master')

@section('title')
    Manage {{$thisAttrName}}
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="row">
            <!-- Form -->
            <div class="col-md-4">
                <div class="card mb-3">
                    <form action="{{ !empty($attribute) ? route('attribute_update') : route('attribute_store') }}"
                          method="post">
                        <h6>
                            <div class="title-with-border ps-3">
                                @if(!empty($attribute))
                                    <span class="text-primary">Edit {{$attribute->unique_name}} Information</span>
                                @else
                                    Information
                                @endif
                            </div>
                        </h6>
                        <div class="card-body">
                            @csrf
                            @if (!empty($attribute))
                                <input type="hidden" name="id" value="{{ $attribute->id }}">
                            @endif
                            <div class="form-group">
                                <label for="name">Name: </label>
                                <input type="text" class="form-control" placeholder="Enter {{$thisAttrIndex}} name"
                                       name="value"
                                       id="title"
                                       value="{{ !empty($attribute) ? $attribute->value : old('value') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug: </label>
                                <input type="text" class="form-control" placeholder="Enter {{$thisAttrIndex}} slug"
                                       name="slug"
                                       id="seo_url"
                                       value="{{ !empty($attribute) ? $attribute->slug : old('slug') }}">
                            </div>

                            <div class="form-group select arrow_class">
                                <label for="slug">Status: </label>
                                @php
                                    $statuses = $Query::getEnumValues('attribute_values', 'status');
                                @endphp
                                <select name="status" id="" class="form-select">
                                    @foreach($statuses as $key => $status)
                                        <option value="{{$status}}"
                                            {{  !empty($attribute) && $status == $attribute->status ? 'selected' : null }}
                                        >{{$status}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Attribute: </label>
                                <input type="text" class="form-control readonly" name="unique_name"
                                       value="{{$thisAttrName}}" required>
                                <input type="hidden" name="index" value="{{ $thisAttrIndex }}">
                            </div>
                        </div>
                        <div class="card-footer form-submit_btn">
                            <input type="submit" class="btn blue" value="Submit"/>
                        </div>
                    </form>
                </div><!-- ENd Form-->
            </div>
            <div class="col-md-8 table-wrapper desktop-view mobile-view">
                <div class="card">
                    <h6>
                        <div class="title-with-border ps-3">
                            All {{$thisAttrName}}
                        </div>
                    </h6>
                    <div class="card-body">
                        <table class="">
                            <thead>
                            <tr>
                                <th></th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Slug</th>
                                <th class="text-center">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php  $getAttribute = $Query::accessModel('AttributeValue')::where('unique_name', $thisAttrName)->get(); @endphp
                            @foreach ($getAttribute as $data)
                                <tr>
                                    <td class="text-center">
                                        {!! $ButtonSet::delete('attribute_'.$thisAttrIndex.'_destroy', [$thisAttrName, $data->id]) !!}
                                        {!! $ButtonSet::edit('attribute_'.$thisAttrIndex.'_edit', [$thisAttrName, $data->id]) !!}
                                    </td>
                                    <td>{{$data->value}}</td>
                                    <td>{{$data->slug}}</td>
                                    <td>{{$data->status}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('cusjs')
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $.noConflict();

            $('#title').blur(function () {
                var m = $(this).val();
                var cute1 = m.toLowerCase().replace(/ /g, '_').replace(/&amp;/g, 'and').replace(/&/g, 'and').replace(/ ./g, 'dec');
                var cute = cute1.replace(/[`~!@#$%^&*()|+\=?;:'"”,.<>\{\}\[\]\\\/-]/gi, '');

                $('#seo_url').val(cute);
            });
        });
    </script>
@endsection
