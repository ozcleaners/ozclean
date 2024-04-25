<!-- Basic Service -->
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                @foreach($basicSetting as $key => $value)
                    @php
                        $inputType = $Model('CalcInputType')::getByAttrId($key);
                        $inputTypeSlug = $Model('CalcInputType')::getAttributeSlug($key);
                        $labelName = $Model('AttributeValue')::getValueById($key);
                        $labelIcon = $Model('CalcInputType')::getInputEle($key, $set_sub_service_id)->input_icon ?? null;
                        $labelSlug = $Model('AttributeValue')::getColumnById($key)->slug;
                        $title = $labelName;
                        $base_price =  0;
                        $extra_default = 0;
                        $additionalInput = ' data-accounts_type="basic"';

                    @endphp
                    @if($inputTypeSlug)
                        {!! \App\Helpers\FieldGenerator::$inputTypeSlug([
                            'dataArr' => $value,
                            'labelIcon' => $Media::iconSize($labelIcon),
                            'imageOn' => false,
                            'value' => 'id',
                            'general_info_id' => $general_infos->id,
                            'label' => 'setting_title',
                            'class' => 'd-inline-block mr-4',
                            'name' => $labelSlug,
                            'labelTitle' => $labelName,
                            'data-class' => 'service_slug',
                            'additional-input-data' => $additionalInput,
                        ]) !!}
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- End Basic Service -->

<div class="breakdown">
    <div class="panel panel-default breakdown_list" data-breakdown="1">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="removeBreakdown"></span> Property Details
            </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <!-- Main Servie -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="type_of_area">Type of area</label>
                        <select class="form-control type_of_area" name="">
                            <option>Select a Service</option>
                            @foreach($mainServiceSetting as $service)
                                <option value="{{ $service->id }}"
                                        {{ $getServiceItem($service->service_title_slug, 'service_slug')  == $service->service_title_slug ? 'selected' : null }}
                                        data-slug="{{$service->service_title_slug}}"
                                        data-accounts_type="main"
                                        data-base_price="{{$service->base_price}}"
                                        data-extra_default="{{$service->extra_default}}"
                                        data-minimum_qty="{{$service->minimum_qty}}"
                                        data-maximum_qty="{{$service->maximum_qty}}"
                                >{{$service->service_title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group size_group">

                    </div>

                    <div class="form-group material_group">
                        <label for="materials">Type of Materials</label>
                        <select class="form-control type_of_materials" name="" id="">
                        </select>
                    </div>
                </div> <!-- Emd Main Service -->

            </div>

            <div class="" id="extra_reload">

                @if(request()->get('material-id'))
                    <h3 class="panel-title">
                        <strong>Extra Services</strong>
                    </h3>
                    <div class="">
                        @php

                            $extraConnectionBaseMaterial = $Model('CalcMaterialSetting')::where('id', request()->get('material-id'))->first()->extras_connection ?? null;

                            $extraServiceSetting = $Model('CalcServiceSetting')::where('service_id', $set_sub_service_id)
                                               ->whereIn('id', explode(',', $extraConnectionBaseMaterial))
                                               ->where('setting_option_type', 35)
                                               ->orderBy('setting_option_type', 'ASC')
                                               ->orderBy('sorting_order', 'ASC')
                                               ->get();

                        @endphp
                        @foreach($extraServiceSetting as $key => $value)
                            {{--                                    @dump($value)--}}
                            @php
                                $inputType = $value->input_type;
                                $inputTypeSlug = $Model('CalcServiceSetting')::getAttributeSlug($value->input_type);
                                $labelName = $value->service_title;
                                $labelSubName = $value->service_sub_title;
                                $labelSlug = $value->service_title_slug;
                                $base_price = $getServiceItem($value->service_title_slug, 'service_base_price')  ?? ($value->base_price ?? 0);
                                $extra_default = $getServiceItem($value->service_title_slug, 'service_extra_default_price') ?? ($value->extra_default ?? 0);
                                $title = $value->service_title;
                                $counterType = $Model('AttributeValue')::getColumnById($value->counter_type)->slug ?? NULL;
                                $getChecked = $getServiceItem($value->service_title_slug, 'service_qty') == null ? null : 'checked';
                                $getValue = $getServiceItem($value->service_title_slug, 'service_qty') == null ? $value->minimum_qty : $getServiceItem($value->service_title_slug, 'service_qty');
                                 $getEquType = $getServiceItem($value->service_title_slug, 'service_equation_type') ?? 'fixed';
                                $additionalInput = '
                                    data-title="'.$title.'"
                                    min="'.$value->minimum_qty.'"
                                    max="'.$value->maximum_qty.'"
                                    value="'.$getValue.'"
                                    data-extra_default="'.$extra_default.'"
                                    data-base_price="'.$base_price.'"
                                    data-equation_type="'.$getEquType.'"
                                    data-service_type="extra"
                                    data-accounts_type="extra"
                                ';
                            @endphp
                            <div class="py-3">
                                <input class="calc-open-modal" type="checkbox" {{$getChecked}}
                                data-counter_type="{{$counterType}}" data-service_type="extra"
                                       data-calc="{{$value->service_title_slug}}" data-accounts_type="extra">
                                {{$value->service_title}}

                                @if($value->tooltips_content)
                                    <i class="toltip fa fa-info badge"
                                       data-toltip="{{$value->service_title_slug}}"></i>
                                @endif
                            </div>
                            @if($value->tooltips_content)
                                <script type="text/template" id="tooltips_{{$value->service_title_slug}}">
                                                {!! $value->tooltips_content !!}
                                </script>
                            @endif
                            <script type="text/template" id="{{$value->service_title_slug}}">
                             @if($inputTypeSlug)
                                    {!! \App\Helpers\FieldGenerator::$inputTypeSlug([
                                        'dataArr' => $value ?? NULL,
                                        'imageOn' => false,
                                        'value' => 'id',
                                        'label' => 'setting_title',
                                        'class' => 'd-inline-block mr-4',
                                        'data-point' => 'pointed',
                                        'data-class' => $value->service_title_slug,
                                        'additional-input-data' => $additionalInput,
                                        'name' => $labelSlug ?? NULL,
                                        'labelSubTitle' => $labelSubName ?? $labelName,
                                        //'labelTitle' => $labelName ?? NULL
                                    ]) !!}
                                @endif
                            </script>
                        @endforeach

                    </div>
                @endif
            </div>

        </div>
    </div>

</div>

<a class="btn btn-info add_breakdown">Add More</a>


@section('cusjs')
    @parent
    <?php
    $getAllServiceItem = $Model('BookingOrderItem')::where('general_info_id', $general_infos->id)->get();?>
    @foreach($getAllServiceItem as $it)
        <div class="get_saved_{{$it->service_slug}}" data-qty="{{$it->service_qty}}"
             data-base_price="{{$it->service_base_price}}"
             data-extra_default="{{$it->service_extra_default_price}}"></div>
    @endforeach

    <script>
        jQuery(document).ready(function ($) {
            $.noConflict();

            function typeOfAreaChange(main_service_id, className) {

                var breadoownid = $(className).parent().closest('.breakdown_list').data('breakdown');
                var tagetBreakdown = `.breakdown_list[data-breakdown=${breadoownid}]`;

                let term_id = "{{ $set_sub_service_id }}";


                let url = `{{ route( 'frontend_service_materials_get', ['', ''])  }}/` + main_service_id + '/' + term_id;
                let df = "driveway";
                $.get(url, function (data, status) {
                    let serviceInfo = data.service_info;
                    let slug = serviceInfo.service_title_slug;
                    let service_title = serviceInfo.service_title;
                    let base_price = $('.get_saved_' + slug).data('base_price') ?? serviceInfo.base_price;
                    let extra_default = $('.get_saved_' + slug).data('extra_default') ?? serviceInfo.extra_default;
                    let setValue = $('.get_saved_' + slug).data('qty');
                    let minimum_qty = setValue ?? serviceInfo.minimum_qty;
                    let maximum_qty = serviceInfo.maximum_qty;
                    let plus_minus_field = `
                      {!! \App\Helpers\FieldGenerator::plus_minus([
                        'value' => 'id',
                        'label' => 'setting_title',
                        'class' => 'd-inline-block mr-4',
                        'data-point' => 'pointed',
                        'data-class' => '${slug}',
                        'additional-input-data' => ' data-accounts_type = "main" data-title="m<sup>2</sup> ${service_title}" min="${minimum_qty}" max="${maximum_qty}" value="${minimum_qty}" data-extra_default="${extra_default}"
                        data-base_price="${base_price}"  data-equation_type="fixed"',
                        'name' => '${slug}',
                        'labelTitle' => '',
                        'labelSubTitle' => 'Size (m<sup>2</sup>)',
                    ]) !!}
                    `;
                    $(tagetBreakdown + ' .size_group').html(plus_minus_field)
                    $(tagetBreakdown + " #extra_reload").load(location.href + " #extra_reload > *")
                    $(tagetBreakdown + ' .type_of_materials').html(data.html);

                });
            }


            // $('.breakdown').on('change','.type_of_materials', function(){
            //     let getbData = $(this).parent().closest('.breakdown_list').data('breakdown');
            //     // alert(getbData)
            //     let mainSelectedTypeOfArea = $(this).find(':selected').val();
            //     // alert(mainSelectedTypeOfArea)
            //     if (mainSelectedTypeOfArea) {
            //         typeOfAreaChange(mainSelectedTypeOfArea, '.breakdown .type_of_area')
            //     }
            // })


            $('.breakdown').on('change', '.type_of_area', function () {
                let main_service_id = $(this).val();
                let breadoownid = $(this).parent().closest('.breakdown_list').data('breakdown');
                // alert(breadoownid)
                typeOfAreaChange(main_service_id, `.breakdown .breakdown_list[data-breakdown=${breadoownid}] .type_of_area`)

            });


            $('.breakdown').on('change', '.type_of_materials', function () {
                var breadoownid = $(this).parent().closest('.breakdown_list').data('breakdown');
                var tagetBreakdown = `.breakdown_list[data-breakdown=${breadoownid}]`;

                let material = $(this).find(':selected').val();

                let getLocation = location.href + '?material-id=' + material;
                console.log(getLocation)
                $(tagetBreakdown + " #extra_reload").load(getLocation + " #extra_reload > *")
            })


            /** Breakdown */
            $('a.add_breakdown').on('click', function () {
                let lastChild = ".breakdown_list:last-child";
                let lastBreakDownList = $(lastChild).data('breakdown');

                $(`.breakdown_list[data-breakdown="${lastBreakDownList}"]`).clone().appendTo('.breakdown');
                let getNewId = parseInt(lastBreakDownList + 1);
                $(lastChild).attr('data-breakdown', getNewId);

                let makeID = `.breakdown_list[data-breakdown="${getNewId}"]`;
                $(makeID + ' span.removeBreakdown').html(' <a href="javascript:void(0)" class="breakdown_remove"><i class="fa fa-trash"></i></a> ')
                $(makeID + ' .size_group').html('')
                $(makeID + ' select.type_of_materials').html('')
                $(makeID + ' #extra_reload').html('')
                // console.log(makeID)
            })

            $('.breakdown').on('click', 'a.breakdown_remove', function (e) {
                e.preventDefault()
                var breadoownid = $(this).parent().closest('.breakdown_list').data('breakdown');
                var tagetBreakdown = `.breakdown_list[data-breakdown=${breadoownid}]`;
                if (breadoownid == 1) {
                    alert('You can Not remove it')
                } else {
                    $(tagetBreakdown).remove();
                }

            })
        });
    </script>
@endsection
