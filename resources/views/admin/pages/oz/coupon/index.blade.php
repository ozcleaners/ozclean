@extends('admin.layouts.master')

@section('title')
    Manage Coupon
@endsection
@section('content')

    <div class="content-wrapper">
        <div class="row">
            <!-- Form -->
            <div class="col-md-4">
                <div class="card mb-3 coupon_form">
                    <form action="{{ !empty($coupon) ? route('oz_coupon_store') : route('oz_coupon_store') }}"
                          method="post">
                        <h6>
                            <div class="title-with-border ps-3">
                                @if(!empty($postcode))
                                    <span class="text-primary">Edit </span>
                                @else
                                    Coupon Information
                                @endif
                            </div>
                        </h6>
                        <div class="card-body">
                            @csrf
                            {{ Form::hidden('coupon_id', (!empty($coupon->coupon_id) ? $coupon->coupon_id : NULL)) }}
                            <div class="form-group">
                                {{ Form::label('coupon_code', 'Coupon Code', array('class' => 'coupon_code')) }}
                                {{ Form::text('coupon_code', (!empty($coupon->coupon_code) ? $coupon->coupon_code : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'Enter coupon code...']) }}
                                <div class="check_coupon_code"></div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('start_date', 'Start Date', array('class' => 'start_date')) }}
                                <?php
                                if (!empty($coupon)) {
                                    if ($coupon->start_date) {
                                        $converted = strtotime($coupon->start_date);
                                        $start_date = date('m/d/Y', $converted);
                                    } else {
                                        $start_date = null;
                                    }
                                    if ($coupon->end_date) {
                                        $converted1 = strtotime($coupon->end_date);
                                        $end_date = date('m/d/Y', $converted1);
                                    } else {
                                        $end_date = null;
                                    }
                                } else {
                                    $start_date = null;
                                    $end_date = null;
                                }

                                ?>

                                {{ Form::text('start_date', (!empty($start_date) ? $start_date : NULL), ['required', 'id' => 'datepicker', 'class' => 'form-control', 'placeholder' => 'Enter start date...']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('end_date', 'End Date', array('class' => 'end_date')) }}
                                {{ Form::text('end_date', (!empty($end_date) ? $end_date : NULL), ['id' => 'datepicker1', 'class' => 'form-control', 'placeholder' => 'Enter end date...']) }}
                            </div>
                            <div class="form-group select arrow_class">
                                {{ Form::label('coupon_type', 'Coupon Type', array('class' => 'coupon_type')) }}

                                <select name="coupon_type" class="form-control form-select" id="coupon_type">
                                    <option value="Fixed" {{ (!empty($coupon->coupon_type) && ($coupon->coupon_type == 'Fixed')) ? 'selected="selected"' : null }}>
                                        Fixed
                                    </option>
                                    <option value="Percentage" {{ (!empty($coupon->coupon_type) && ($coupon->coupon_type == 'Percentage')) ? 'selected="selected"' : null }}>
                                        Percentage
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                {{ Form::label('coupon_amount', 'Coupon Amount', array('class' => 'coupon_amount')) }}
                                <div class="input-group">
                                    {{ Form::text('coupon_amount', (!empty($coupon->coupon_amount) ? $coupon->coupon_amount : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'Enter Amount...']) }}
                                    <div class="input-group-addon amount-charge-type"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('up_to', 'Coupon Up To Value', array('class' => 'up_to')) }}
                                <div class="input-group">
                                    {{ Form::text('up_to', (!empty($coupon->up_to) ? $coupon->up_to : NULL), ['class' => 'form-control', 'placeholder' => 'Enter coupon up to value...']) }}

                                </div>

                            </div>
                            <div class="form-group">
                                {{ Form::label('coupon_min', 'Coupon Minimum Amount', array('class' => 'coupon_min')) }}
                                <div class="input-group">
                                    {{ Form::text('coupon_min', (!empty($coupon->coupon_min) ? $coupon->coupon_min : NULL), ['class' => 'form-control', 'placeholder' => 'Enter coupon up to value...']) }}
                                </div>
                            </div>
                            <div class="form-group select arrow_class">
                                {{ Form::label('limit_type', 'Limit Type', array('class' => 'allow_type')) }}

                                <select name="limit_type" class="form-select" id="limit_type" required>
                                    <option value="Unlimited" {{ (!empty($coupon->limit_type) && ($coupon->limit_type == 'Unlimited')) ? 'selected="selected"' : null }}>
                                        Unlimited
                                    </option>
                                    <option value="Custom" {{ (!empty($coupon->limit_type) && ($coupon->limit_type == 'Custom')) ? 'selected="selected"' : null }}>
                                        Custom
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                {{ Form::label('how_many_uses', 'Use Limit', array('class' => 'how_many_uses')) }}
                                {{ Form::text('how_many_uses', (!empty($coupon->how_many_uses) ? $coupon->how_many_uses : NULL), ['class' => 'form-control', 'id'=> 'how_many_uses', 'placeholder' => 'Enter how many uses...']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('person_limit_user', 'Per person use limit', array('class' => 'person_limit_user')) }}
                                {{ Form::number('person_limit_user', (!empty($coupon->person_limit_user) ? $coupon->person_limit_user : 1), ['min' => 1, 'class' => 'form-control', 'id'=> 'how_many_uses', 'placeholder' => 'Enter per person use limit...']) }}
                            </div>


                            <div class="form-group select arrow_class">
                                {{ Form::label('allow_type', 'Allow Type', array('class' => 'allow_type')) }}

                                <select name="allow_type" class="form-select" id="allow_type" required>
                                    <option value="All" {{ (!empty($coupon->allow_type) && ($coupon->allow_type == 'All')) ? 'selected="selected"' : null }}>
                                        All
                                    </option>
                                    <option value="Custom" {{ (!empty($coupon->allow_type) && ($coupon->allow_type == 'Custom')) ? 'selected="selected"' : null }}>
                                        Custom
                                    </option>
                                </select>
                            </div>


                            <?php
                            $services = $Model('Term')::where('parent', 3)->get();
                            ?>

                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h5 class="box-title">Services <span id="photoCounter"></span></h5>
                                    <div class="col-xs-12 post_cats" style="margin-top: 15px;">
                                        <div class="pre-scrollable">

                                            <ul id="categories-id-1" class="" style="list-style: none;">
                                                @foreach($services as $service)
                                                    @php
                                                        $subServices = $Model('Term')::where('parent', $service->id)->get();
                                                    @endphp

                                                    <li class="">
                                                        <strong>{{ $service->name }}</strong>
                                                        <ul class="">
                                                            @foreach($subServices as $sub)
                                                                @php
                                                                  $check_service = !empty($coupon->coupon_service) ? explode(',',$coupon->coupon_service) : [];
                                                                    $checked = in_array($sub->id, $check_service) ? 'checked' : '';
                                                                @endphp
                                                            <li>
                                                                <label>
                                                                <input type="checkbox" name="coupon_service[]"
                                                                       value="{{$sub->id}}"
                                                                       class="service-item h-auto" {{ $checked }}>
                                                                {{ $sub->name }}
                                                                </label>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach

                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('is_active', 'Activity', array('class' => 'is_active')) }}
                                <div class="radio">
                                    <label class="w-100 me-2">
                                        {{ Form::radio('is_active', 1, ((!empty($coupon) && $coupon->is_active == 1)? TRUE : FALSE), ['class' => 'radio h-auto']) }}
                                        Active
                                    </label>
                                </div>
                                <div class="radio">
                                    <label class="w-100">
                                        {{ Form::radio('is_active', 0, ((!empty($coupon) && $coupon->is_active == 0)? TRUE : FALSE), ['class' => 'radio h-auto']) }}
                                        Inactive
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('notes', 'Notes', array('class' => 'notes')) }}
                                {{ Form::text('notes', (!empty($coupon->notes) ? $coupon->notes : NULL), ['class' => 'form-control', 'placeholder' => 'Enter notes...']) }}
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
                            Coupons
                        </div>
                    </h6>
                    <div class="card-body">
                        <table class="">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Code</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Use Limit</th>
                                <th>Up To</th>
                                <th>Notes</th>
                                <th>Service</th>
                                <th>Actioon</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php  $coupons = $Model('Coupon')::get(); @endphp
                            @foreach ($coupons as $coupon)
                                <tr>
                                    <td class="text-center">
                                        {!! $ButtonSet::delete('oz_coupon_destroy', $coupon->id) !!}
                                        {!! $ButtonSet::edit('oz_coupon_edit', $coupon->id) !!}
                                    </td>
                                    <td>
                                        @if($coupon->is_active == 1 )
                                            <i class="fa fa-circle text-success d-inline-block" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-circle text-danger d-inline-block" aria-hidden="true"></i>
                                        @endif

                                        {{ $coupon->coupon_code }}
                                    </td>
                                    <td>

                                        ${{ $coupon->coupon_amount }}
                                        {{ ($coupon->coupon_type == 'Fixed')? 'Fixed' : '%' }}


                                    </td>
                                    <td>
                                        <b>Start:</b> {{ $coupon->start_date }}<br>
                                        <b>End:</b> {{ $coupon->end_date }}
                                    </td>
                                    <td>
                                        @if($coupon->limit_type == 'Unlimited')
                                            {{ 'Unlimited' }}
                                        @else
                                            {{ $coupon->how_many_uses }}
                                        @endif

                                    </td>
                                    <td>{{ $coupon->up_to }}</td>
                                    <td>{{ $coupon->notes }}</td>
                                    <td>
                                        @if($coupon->allow_type =='Custom')

                                            <button type="button" class="btn btn-info btn-xs" data-toggle="modal"
                                                    data-target="#view-service{{$coupon->id}}"> {{ $coupon->allow_type }} </button>

                                            <div class="modal fade" tabindex="-1" role="dialog"
                                                 aria-labelledby="mySmallModalLabel" id="view-service{{$coupon->id}}">
                                                <div class="modal-dialog modal-sm" role="document">

                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title"
                                                                id="myModalLabel">{{ $coupon->allow_type }} service</h4>
                                                        </div>
                                                        <div class="modal-body">

                                                            @php

                                                                $c_services = explode(',',$coupon->coupon_service);
                                                                foreach($c_services as $cs){

                                                                 $s_info = App\Post::where(['categories' => 5, 'id' => $cs])->get()->first();
                                                                 echo $s_info->title . '<br>';

                                                                }



                                                            @endphp

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close
                                                            </button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            {{ $coupon->allow_type }}

                                        @endif

                                    </td>

                                    <td>
                                        <a class="btn btn-xs btn-info"
                                           href="{{ url("edit_coupon/{$coupon->id}") }}">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>

                                        @if($coupon->is_active == 1)
                                            <a class="btn btn-xs btn-success"
                                               href="{{ url("coupon_status/{$coupon->id}/0") }}">
                                                <i class="fa fa-check"></i>
                                            </a>
                                        @else
                                            <a class="btn btn-xs btn-danger"
                                               href="{{ url("coupon_status/{$coupon->id}/1") }}">
                                                <i class="fa fa-check-square-o"></i>
                                            </a>

                                        @endif

                                    </td>
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
    <style>
        .coupon_form .form-group label{
            width: 40%;
        }
        .coupon_form .form-group {
            margin-bottom: 4px;
        }
        .pre-scrollable {
            max-height: 340px;
            overflow-y: scroll;
        }
    </style>
@endsection
