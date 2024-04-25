<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            Property Details
        </h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <!-- Main Service -->
            <div class="col-md-6">
                @foreach($mainServiceSetting as $key => $value)
                    {{-- @dump($value) --}}
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
                        $getValue = $getServiceItem($value->service_title_slug, 'service_qty') == null ? $value->minimum_qty : $getServiceItem($value->service_title_slug, 'service_qty');
                        $getEquType = $getServiceItem($value->service_title_slug, 'service_equation_type') ?? 'fixed';
                        $getServiceAmount= $getServiceItem($value->service_title_slug, 'service_amount') ?? null;
                        $additionalInput = '
                            data-title="'.$title.'"
                            min="'.$value->minimum_qty.'"
                            max="'.$value->maximum_qty.'"
                            value="'.$getValue.'"
                            data-extra_default="'.$extra_default.'"
                            data-service-amount="'.$getServiceAmount.'"
                            data-base_price="'.$base_price.'"
                            data-equation_type="'.$getEquType.'"
                            data-accounts_type="main"
                        ';

                    $templates = function() use($inputTypeSlug, $value,$additionalInput, $labelSlug, $labelName){
                          if($inputTypeSlug) {
                                  return  \App\Helpers\FieldGenerator::$inputTypeSlug([
                                        'dataArr' => $value ?? NULL,
                                        'imageOn' => $value->service_icon,
                                        'value' => 'id',
                                        'label' => 'setting_title',
                                        'class' => 'd-inline-block mr-4',
                                        'data-point' => 'pointed',
                                        'data-class' => $value->service_title_slug,
                                        'additional-input-data' => $additionalInput,
                                        'name' => $labelSlug ?? NULL,
                                        'labelTitle' => $labelName ?? NULL,
                                        //'labelSubTitle' => $labelSubName ?? NULL
                                        'labelSubTitle' => $labelName ?? NUll,
                                        'notes' => $value->notes,
                                    ]);
                            }
                    }


                    @endphp
                    @if($counterType == 'regular')
                        {!! $templates() !!}
                    @else
                        <div class="py-3">
                            <label class="containerx">
                                <input class="calc-open-modal" type="checkbox"
                                       data-counter_type="{{$counterType}}"
                                       data-calc="{{$value->service_title_slug}}">
                                @if(isset($value->service_icon))
                                    <img style="width: 36px; max-height: 36px;"
                                         src=" {{ $Model('Media')::iconSize($value->service_icon) }}"/>
                                @endif
                                {{$value->service_title}}
                                <span class="checkmark"></span>
                            </label>
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
                        {!! $templates() !!}
                        </script>

                    @endif
                @endforeach
            </div>
            <!-- Main Service -->
            <!-- Basic Service -->
            {{-- dump($key); --}}
            {{-- dump($set_sub_service_id); --}}
            <div class="col-md-6 basic_service_side">
                @foreach($basicSetting as $key => $value)
                    @php
          				$inputType = $Model('CalcInputType')::getByAttrId($key, ['service_id' => $set_sub_service_id]);
                        $inputTypeSlug = $Model('CalcInputType')::getAttributeSlug($key,  ['service_id' => $set_sub_service_id]);
                        $labelName = $Model('AttributeValue')::getValueById($key);
                        $labelSlug = $Model('AttributeValue')::getColumnById($key)->slug;
                        $title = $Model('CalcInputType')::getInputEle($key, $set_sub_service_id);
                        $labelIcon = $Model('CalcInputType')::getInputEle($key, $set_sub_service_id)->input_icon ?? null;
                        $base_price =  0;
                        $extra_default = 0;
                        $additionalInput = ' data-accounts_type="basic"';
                        $service_icon = $value['service_icon'] ?? NULL;
                        //dump($labelIcon);
                    @endphp
                    @if($inputTypeSlug)
                        {!! \App\Helpers\FieldGenerator::$inputTypeSlug([
                            'dataArr' => $value,
                            'labelIcon' => $Media::iconSize($labelIcon),
                            'imageOn' => $service_icon ?? NULL,
                            'general_info_id' => $general_infos->id,
                            'value' => 'id',
                            'label' => 'setting_title',
                            'class' => 'd-inline-block mr-4',
                            'name' => $labelSlug,
                            'labelTitle' => $labelName,
                            'data-class' => $labelSlug,
                            'additional-input-data' => $additionalInput,
                        ]) !!}
                    @endif
                @endforeach
            </div> <!-- End Basic Service -->
        </div>
    </div>
</div>

<!-- Extra Service -->

@if(count($extraServiceSetting) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Extra Services
            </h3>
        </div>
        <div class="panel-body row align-items-center">
            @foreach($extraServiceSetting as $key => $value)
                {{--                                    @dump($value)--}}
                @php
                    $inputType = $value->input_type;
                    $inputTypeSlug = $Model('CalcServiceSetting')::getAttributeSlug($value->input_type);
                    $labelName = $value->service_title;
                    $labelSlug = $value->service_title_slug;
                    $base_price = $getServiceItem($value->service_title_slug, 'service_base_price')  ?? ($value->base_price ?? 0);
                    $extra_default = $getServiceItem($value->service_title_slug, 'service_extra_default_price') ?? ($value->extra_default ?? 0);
                    $title = $value->service_title;
                    $counterType = $Model('AttributeValue')::getColumnById($value->counter_type)->slug ?? NULL;
                    $getChecked = $getServiceItem($value->service_title_slug, 'service_qty') == null ? null : 'checked';
                    $getValue = $getServiceItem($value->service_title_slug, 'service_qty') == null ? $value->minimum_qty : $getServiceItem($value->service_title_slug, 'service_qty');
                    $getEquType = $getServiceItem($value->service_title_slug, 'service_equation_type') ?? 'fixed';
                    $getServiceAmount= $getServiceItem($value->service_title_slug, 'service_amount');
                    $additionalInput = '
                        data-title="'.$title.'"
                        min="'.$value->minimum_qty.'"
                        max="'.$value->maximum_qty.'"
                        value="'.$getValue.'"
                        data-service-amount="'.$getServiceAmount.'"
                        data-extra_default="'.$extra_default.'"
                        data-base_price="'.$base_price.'"
                        data-equation_type="'.$getEquType.'"
                        data-service_type="extra"
                        data-accounts_type="extra"
                        data-minimum_price = "'.$value->minimum_price.'"
                    ';
                @endphp
                <div class="py-3 col-lg-4 col-md-4">
                    <label class="containerx d-inline-flex align-items-center">
                        <input class="calc-open-modal" type="checkbox" {{$getChecked}}
                        data-counter_type="{{$counterType}}" data-service_type="extra"
                               data-calc="{{$value->service_title_slug}}" data-accounts_type="extra">
                        <span class="checkmark"></span>
                        @if(isset($value->service_icon))
                            <img style="width: 45px; height: 45px; margin-right: 5px;"
                                 src=" {{ $Model('Media')::iconSize($value->service_icon) }}"/>
                        @endif
                        {{$value->service_title}}

                    </label>
                    @if($value->tooltips_content)
                        <i class="toltip fa fa-info badge"
                           data-toltip="{{$value->service_title_slug}}"></i>
                    @endif

                </div>
                @if($value->tooltips_content)
                    <script type="text/template" id="tooltips_{{$value->service_title_slug}}">
                      <p class="text-center"><img src="{{$Media::fullSize($value->service_icon)}}" style="width: 100px" /></p>
                      {!! $value->tooltips_content !!}
                    </script>
                @endif
                <script type="text/template" id="{{$value->service_title_slug}}">
                @if($inputTypeSlug)
                        {!! \App\Helpers\FieldGenerator::$inputTypeSlug([
                            'dataArr' => $value ?? NULL,
                            'imageOn' => $value->service_icon ?? false,
                            'value' => 'id',
                            'label' => 'setting_title',
                            'class' => 'd-inline-block mr-4',
                            'data-point' => 'pointed',
                            'data-class' => $value->service_title_slug,
                            'additional-input-data' => $additionalInput,
                            'name' => $labelSlug ?? NULL,
                            'labelTitle' => $labelName ?? NULL,
                            'labelSubTitle' => $labelName,
                            'notes' => $value->notes,
                        ]) !!}
                    @endif
                </script>
            @endforeach

        </div>
    </div>
@endif



