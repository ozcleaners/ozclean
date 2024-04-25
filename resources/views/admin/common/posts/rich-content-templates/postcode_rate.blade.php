<div class="content-wrappexr">
    <div class="row">
        <h6>
            <div class="title-with-border ps-3">
                Browse a file
            </div>
        </h6>
        <div class="card-body">
            <form action="{{ route('common_term_import_postcode') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="service_id" value="{{request()->id}}">
                <input type="hidden" name="zone_id" value="{{$zone_id}}">
                <div class="form-group">
                    <input type="file" name="file" class="form-controlx"/>
                </div>
                <div class="form-submit_btn">
                    <button type="submit" class="btn btn-sm btn-success">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

<h1>Or,</h1>

@php
    $postcodeThisZone = $Model('Postcode')::where('zone_id', $zone_id)->get();
@endphp
<form class="" action="{{route('common_term_postcode_rate_store_update', request()->id)}}" method="post">
    @csrf
    <input type="hidden" name="service_id" value="{{request()->id}}">
    <input type="hidden" name="zone_id" value="{{$zone_id}}">
    <div class="form-group">
        <label for="post_code" class="post_code images">Post code</label>
        @foreach($postcodeThisZone as $code)
            @if($Model('PostcodeRate')::getData(request()->id, $zone_id, ['column' => 'postcode_id', 'postcode_id' => $code->id]) != $code->id)
                <label class="w-auto m-1">
                    <input type="checkbox"
                           {{--                   {{$Model('PostcodeRate')::getData(request()->id, $zone_id, ['column' => 'postcode_id', 'postcode_id' => $code->id]) == $code->id ? 'checked' : null}}--}}
                           name="postcode_id[]" class="h-auto" value="{{$code->id}}"> {{$code->postcode}}
                </label>
            @endif
        @endforeach
    </div>

    <div class="form-group">
        <label for="equation_type" class="equation_type">Equation Type</label>
        @php
            $equation_type = $Model('AttributeValue')::getValues('Equation Type');
        @endphp
        <select class="form-select" name="equation_type">
            <option>Select equation type</option>
            @foreach ($equation_type as $index => $option)
                <option value="{{ $option->id ?? NULL }}"
                    {{--                    {{$Model('PostcodeRate')::getData(request()->id, $zone_id, ['column' => 'equation_type']) == $option->id ? 'selected' : null}}--}}
                >
                    {{ $option->value ?? NULL }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="rate" class="rate">Rate</label>
        <input required="" class="form-control" placeholder="Enter rate..." name="rate" type="text" id="rate"
               xvalue="{{$Model('PostcodeRate')::getData(request()->id, $zone_id, ['column' => 'rate'])}}">
    </div>

    <div class="form-submit_btn">
        <input type="submit" class="btn blue" value="Submit"/>
    </div>

</form>


<script type="text/template" id="this_zone_postcode">
    <div class="table-wrapper desktop-view mobile-view">
        <table class="">
            <thead>
            <tr>
                <th></th>
                <th class="text-center">Zone</th>
                <th class="text-center">Postcode</th>
                <th class="text-center">Equation Type</th>
                <th class="text-center">Rate</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Model('PostcodeRate')::getData(request()->id, $zone_id) as $data)
                <tr>
                    <td class="text-center">
                        {!! $ButtonSet::delete('common_term_postcode_rate_destroy', $data->id) !!}
                    </td>
                    <td>{{$Model('AttributeValue')::getValueById($data->zone_id)}}</td>
                    <td>{{$data->postcode}}</td>
                    <td>{{$Model('AttributeValue')::getValueById($data->equation_type)}}</td>
                    <td>{{$data->rate}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</script>

@section('cusjs')
    <script>
        $('#reload_me').html($('script#this_zone_postcode').html())
    </script>
@endsection
