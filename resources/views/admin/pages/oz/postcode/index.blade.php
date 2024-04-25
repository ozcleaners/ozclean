@extends('admin.layouts.master')

@section('title')
    Manage Postcode
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="row">
            <!-- Form -->
            <div class="col-md-4">
                <div class="card mb-3">
                    <form action="{{ !empty($postcode) ? route('oz_postcode_store') : route('oz_postcode_store') }}"
                          method="post">
                        <h6>
                            <div class="title-with-border ps-3">
                                @if(!empty($postcode))
                                    <span class="text-primary">Edit </span>
                                @else
                                   Postcode Information
                                @endif
                            </div>
                        </h6>
                        <div class="card-body">
                            @csrf
                            @if (!empty($postcode))
                                <input type="hidden" name="id" value="{{ $postcode->id }}">
                            @endif

                            <div class="form-group select arrow_class">
                                <label for="slug">Zone: </label>
                                @php
                                    $zones = $Model('AttributeValue')::where('unique_name', 'Zone')->get();
                                @endphp
                                <select name="zone_id" id="" class="form-select" required>
                                    <option value="">Select </option>
                                    @foreach($zones as $key => $zone)
                                        <option value="{{$zone->id}}"
                                            {{  !empty($postcode) && $zone->id == $postcode->zone_id ? 'selected' : null }}
                                        >{{$zone->value}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Postcode: </label>
                                <input type="text" class="form-control" placeholder="Enter postcode"
                                       name="post_code"
                                       id="title"
                                       value="{{ !empty($postcode) ? $postcode->postcode : old('postcode') }}" required>
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
                            All Postcode
                        </div>
                    </h6>
                    <div class="card-body">
                        <table class="">
                            <thead>
                            <tr>
                                <th></th>
                                <th class="text-center">Zone</th>
                                <th class="text-center">Postcode</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php  $getPostCodes = $Model('Postcode')::get(); @endphp
                            @foreach ($getPostCodes as $data)
                                <tr>
                                    <td class="text-center">
                                        {!! $ButtonSet::delete('oz_postcode_destroy', $data->id) !!}
                                        {!! $ButtonSet::edit('oz_postcode_edit', $data->id) !!}
                                    </td>
                                    <td>{{$Model('AttributeValue')::getValueById($data->zone_id)}}</td>
                                    <td>{{$data->postcode}}</td>
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

@endsection

