@extends('admin.layouts.master')
@section('title')
    Manage Schedule
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3 schedule_form">
                    <form action="{{ route('oz_schedule_save') }}"
                          method="post">
                        @csrf
                        <h6>
                            <div class="title-with-border ps-3">
                                @if(!empty($schedule))
                                    <input type="hidden" name="id" value="{{$schedule->id}}">
                                    <span class="text-primary">Edit </span>
                                @else
                                    Schedule Information
                                @endif
                            </div>
                        </h6>
                        <div class="card-body">
                            <div class="form-group">
                                {{ Form::label('service_id', 'Service', array('class' => 'service_id')) }}
                                <?php  $services = $Model('Term')::where('parent', 3)->get(); ?>
                                <select class="form-select" name="service_id">
                                    <option value="">Select Service</option>
                                    @foreach($services as $pService)
                                        <option value="" disabled>{{$pService->name}}</option>
                                        @foreach($Model('Term')::where('parent', $pService->id)->get() as $service)
                                            <option
                                                value="{{ $service->id }}" @if(!empty($schedule)) {{ ($schedule->service_id === $service->id) ? 'selected="selected"' : NULL }} @endif>
                                                --{{ $service->name }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                {{ Form::label('zone', 'Zone', array('class' => 'date')) }}
                                <?php $zones = $Model('AttributeValue')::getValues('Zone');
                                // dump($zones);
                                ?>
                                <select class="form-select" name="zone_id">
                                    <option value="">Select Zone</option>
                                    @foreach($zones as $zone)
                                        <option
                                            value="{{ $zone->id }}" @if(!empty($schedule)) {{ (@$schedule->zone_id === $zone->id) ? 'selected="selected"' : NULL }} @endif>
                                            {{ $zone->value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <?php
                            if (!empty($schedule->date)) {
                                $loaded = date('d/m/Y', strtotime($schedule->date));
                            } else {
                                $loaded = null;
                            }
                            //dd($schedule->date);
                            ?>
                            <small class="custom_label">Pick a date range for schedule</small>

                            <div class="form-group">
                                {{ Form::text('date_range', null, ['required', 'class' => 'form-control', 'id'=> 'date_range']) }}
                            </div>

                            <small class="custom_label">Pick a starting hour range for schedule</small>
                            <div class="form-group">
                                {{ Form::text('time_range', null, ['required', 'class' => 'form-control', 'id'=> 'from_hour_within_hour']) }}
                            </div>

                            <small class="custom_label">Pick teams</small>
                            <div class="form-group">
                                <div class="form-check">
                                    @php
                                        $teams = $Model('Roleuser')::where('role_id', 13)->get();
                                    @endphp
                                    @foreach($teams as $team)
                                        <div class="form-group d-inline-flex me-2">
                                            <input type="checkbox" id="routelist_index_{{ $team->id }}"
                                                   class="checkItem"
                                                   name="teams[]"
                                                   value="{{ $team->user_id }}">
                                            <label class="w-100" for="routelist_index_{{ $team->id }}">
                                                {{ $Model('User')::where('id', $team->user_id)->first()->name ?? NULL }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('is_active', 'Team Availability', array('class' => 'is_active images')) }}
                                <div class="radio">
                                    <label class=" w-100 me-2">
                                        {{ Form::radio('team_availability', 1, (!empty($schedule) ? (($schedule->team_availability == 1) ? TRUE : FALSE) : TRUE), ['class' => 'radio h-auto']) }}
                                        Yes
                                    </label>
                                </div>
                                <div class="radio">
                                    <label class="w-100">
                                        {{ Form::radio('team_availability', 0, (!empty($schedule) ? (($schedule->team_availability == 0) ? TRUE : FALSE) : null), ['class' => 'radio h-auto']) }}
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('is_booked', 'Booked Status', array('class' => 'is_booked images')) }}
                                <div class="radio">
                                    <label class=" w-100 me-2">
                                        {{ Form::radio('is_booked', 1, (!empty($schedule) ? (($schedule->is_booked == 1) ? TRUE : FALSE) : TRUE), ['class' => 'radio h-auto']) }}
                                        Yes. This slot still un booked
                                    </label>
                                </div>
                                <div class="radio">
                                    <label class="w-100">
                                        {{ Form::radio('is_booked', 0, (!empty($schedule) ? (($schedule->is_booked == 0) ? TRUE : FALSE) : null), ['class' => 'radio h-auto']) }}
                                        No. This slot already booked
                                    </label>
                                </div>
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
                            Schedule
                            <div class="btn-group btn-group-sm d-inline-block float-end valign-text-bottom me-2"
                                 role="group" aria-label="...">
                                <a type="button" class="btn btn-warning"
                                   href="{{ route('oz_schedule_generator') }}">
                                    Generate Schedule
                                </a>
                                <a type="button" class="btn btn-success" href="{{ route('common_term_index') }}">
                                    <span class="icon-plus"></span>
                                </a>
                            </div>
                        </div>
                    </h6>
                    <div class="card-body">
                        @php
                            $schedules = $Model('Schedulemanager')::orderBy('id', 'desc')
                                                ->paginate(30);
                        @endphp
                        @if(count($schedules) > 0)
                            <div class="card-body">
                                <table class="">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Service Type</th>
                                        <th>Date</th>
                                        <th>Day</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Slot</th>
                                        <th>Is Booked</th>
                                        <th>Is Active</th>
                                        <th>Date Created</th>
                                        <th>Date Updated</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($schedules as $schedule)
                                        <tr>
                                            <td>
                                                {!! $ButtonSet::delete('oz_schedule_destroy', $schedule->id) !!}
                                                {!! $ButtonSet::edit('oz_schedule_edit', $schedule->id) !!}
                                            </td>
                                            <td>
                                                <?php $post = $Model('Term')::where('id', $schedule->service_id)->get()->first(); ?>
                                                {{ $post['name'] ?? NULL }}
                                            </td>
                                            <td>
                                                <?php
                                                if (!empty($schedule->date)) {
                                                    $correct_format = date('d/m/Y', strtotime($schedule->date));
                                                } else {
                                                    $correct_format = null;
                                                }
                                                ?>
                                                {{ $correct_format }}
                                            </td>
                                            <td>{{ $schedule->day }}</td>
                                            <td>{{ $schedule->month }}</td>
                                            <td>{{ $schedule->year }}</td>
                                            <td>{{ $schedule->from_hour }} - {{ $schedule->within_hour }}</td>
                                            <td>{{ $schedule->is_booked }}</td>
                                            <td>{{ $schedule->team_availability }}</td>
                                            <td>{{ $schedule->created_at }}</td>
                                            <td>{{ $schedule->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                {{ $schedules->links('components.paginator', ['object' => $schedules]) }}
                            </div>
                        @else
                            <div class="card-body">
                                <h6>No schedule has been added</h6>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('cusjs')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <script>
        jQuery(function () {
            $('#date_range').daterangepicker({
                opens: 'right'
            }, function (start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });

            $('#from_hour_within_hour').daterangepicker({
                timePicker: true,
                timePicker24Hour: true,
                timePickerIncrement: 1,
                timePickerSeconds: false,
                locale: {
                    format: 'HH:mm'
                }
            }).on('show.daterangepicker', function (ev, picker) {
                picker.container.find(".calendar-table").hide();
            });
        });
    </script>

@endsection
