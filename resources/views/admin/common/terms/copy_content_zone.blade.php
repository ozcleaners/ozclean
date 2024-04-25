@extends('admin.layouts.master')
@section('title')
    Copy content one to another category
@endsection
@section('filter')

@endsection
@section('content')
    @if(!empty(request()->id))
        <div class="content-wrapper">
           <b> Content Copy from {{$from_zone}} Zone</b>
            <div class="row">
                <div class="col-md-4 py-2 text-center">

                    <form action="{{route('common_term_copy_zone_content')}}" method="post">
                        @csrf
                        <input type="hidden" value="{!! request()->id ?? NULL !!}" name="term_id"/>
                        <input type="hidden" value="{!! $from_zone !!}" name="from_zone"/>
                        <div class="form-group">
                            <label for="copy_to">Copy To...</label>
                            @php
                                $zones = $Model('AttributeValue')::where('unique_name', 'Zone')->get();
                            @endphp
                            <select name="copy_to_zone" id="zone" class="form-control" required>
                                <option value="">Select a zone</option>
                                @foreach($zones as $val)
                                    @if($val->value  == $from_zone)
                                    @else
                                    <option value=" {{ $val->value }}"> {{ $val->value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label style="width: 20%;">&nbsp;</label>
                            <div class="form-submit_btn">

                                <button type="submit" id="menu-generator-cat-submit"
                                        class="btn blue">
                                    Start Copy
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endif
@endsection
