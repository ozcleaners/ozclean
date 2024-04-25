@component('components.boxcard')
    @slot('title')
        List service setting of {{ $Model('Term')::getColumn(request()->id, 'name') }}
        <div class="d-inline-block float-end valign-text-bottom me-2">
            <a href="{{ route('calculator_service_setting_index', request()->id) }}">
                <span class="icon-plus"></span>
            </a>
        </div>
    @endslot
    @slot('fields')
        <div id="reload_me">
            <table class="table table-bordered table-non-striped">
                <thead>
                <tr>
                    <th style="width: 20%;"></th>
                    <th style="width: 25%;" class="text-center">Details</th>
                    <th class="text-center">Other Configurations</th>
                </tr>
                </thead>

                <tbody id="sortable">
                @php
                    $contents = $Query::accessModel('CalcServiceSetting')::where('service_id', request()->id)->orderBy('sorting_order', 'asc')->groupBy('setting_option_type')->get();
                @endphp

                @if(count($contents) > 0)
                    @foreach($contents as $key => $value)
                        @php
                            $success = ' border-top bg-light';
                        @endphp
                        <tr>
                            <td colspan="7">
                                <strong>
                                    {{ $Model('AttributeValue')::getValueById($value->setting_option_type) }}
                                    Service
                                </strong>
                            </td>
                        </tr>
                        @php
                            $subContents = $Query::accessModel('CalcServiceSetting')::where('service_id', request()->id)
                                            ->where('setting_option_type', $value->setting_option_type)
                                            ->orderBy('sorting_order', 'asc')->get();
                            //dump($subContents);
                        //dump($value->setting_option_type);
                        @endphp
                        @if(count($subContents) > 0)
                            @foreach($subContents as $key => $subValue)
                                <tr style="cursor: move;" id="item-{{ $subValue->id }}"
                                    class="{{ $subValue->id == request()->get('section_id') ? $success : null }}">
                                    <td>
                                        @if($subValue->material_available == 'Yes')
                                            @if($Model('AttributeValue')::getValueById($subValue->setting_option_type) == 'Main')
                                                <a class="d-block addMaterial py-0"
                                                   id="addMaterial"
                                                   data-sectionid="{{ $subValue->id }}"
                                                   data-serviceid="{{ request()->id }}"
                                                   type="button"
                                                   href="javascript:void(0)">
                                                    <i class="icon-plus-circle text-primary"></i>
                                                    &nbsp;&nbsp;Add type of material
                                                </a>
                                            @endif
                                        @endif
                                        @if($subValue->storey_available == 'Yes')
                                            <a class="d-block addStorey py-0"
                                               id="addStorey"
                                               data-sectionid="{{ $subValue->id }}"
                                               data-serviceid="{{ request()->id }}"
                                               type="button"
                                               href="javascript:void(0)">
                                                <i class="icon-plus-circle text-primary"></i>
                                                &nbsp;&nbsp;Add No Of Storey
                                            </a>
                                        @endif

                                        <a class="d-inline-block py-0"
                                           href="{{ route('calculator_service_setting_edit', [request()->id]) }}?section_id={{ $subValue->id }}">
                                            <i class="icon-edit text-primary"></i> &nbsp; Edit
                                        </a>
                                        <br/>
                                        {!! $ButtonSet::delete('calculator_service_setting_destroy', $subValue->id, ['title' => 'Delete']) !!}
                                    </td>
                                    <td>
                                        <strong>Title:</strong>
                                        {{ $subValue->service_title ?? NULL }} <br/>
                                        <strong>Service Category:</strong>
                                        {{ $Model('AttributeValue')::getValueById($subValue->setting_option_type) }}
                                        <br/>
                                        <strong>
                                            Base Price:
                                        </strong> {{ $subValue->base_price ??  NULL }}<br/>
                                        <strong>
                                            Default Price:
                                        </strong> {{ $subValue->extra_default ??  NULL }}<br/>

                                        <strong>
                                            Min Quantity:
                                        </strong> {{ $subValue->minimum_qty ??  NULL }}<br/>
                                        <strong>
                                            Max Quantity:
                                        </strong> {{ $subValue->maximum_qty ??  NULL }}<br/>
                                        <strong>
                                            Calculation Type:
                                        </strong> {{ $Model('AttributeValue')::getValueById($subValue->calculation_type) }}
                                        <br/>
                                        <strong>
                                            Counter Type:
                                        </strong> {{ $Model('AttributeValue')::getValueById($subValue->counter_type) }}
                                        <br/>
                                        <strong>
                                            Computable:
                                        </strong> {{ $subValue->computable ?? NULL }}
                                    </td>
                                    <td>
                                        <div class="row">
                                            @php
                                                $materials = $Model('CalcMaterialSetting')::where('section_id', $subValue->id)->get();
                                            @endphp
                                            @if(count($materials) > 0)
                                                <div class="col-md-6 buttonDiv">
                                                    <strong>Type of materials: </strong>
                                                    <br/>

                                                    @foreach($materials as $material)
                                                        <a class="btn btn-sm btn-outline-primary d-block"
                                                           href="{{ route('calculator_service_setting_index', request()->id) }}?material_id={{ $material->id }}&section_id={{ $subValue->id }}">
                                                            <i class="icon-edit text-primary"></i> {{ $material->material_title ?? NULL }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="col-md-6">
                                                    This service don't have any materials
                                                </div>
                                            @endif
                                            @php
                                                $storeys = $Model('CalcBasicSetting')::where('section_id', $subValue->id)->where('service_id', request()->id)->where('which_module', 'Other')->get();
                                            @endphp
                                            @if(count($storeys) > 0)
                                                <div class="col-md-6 buttonDiv">
                                                    <strong>No of storey: </strong>
                                                    <br/>
                                                    @foreach($storeys as $storey)
                                                        <a class="btn btn-sm btn-outline-primary d-block"
                                                           href="{{ route('calculator_service_setting_index', request()->id) }}?storey_id={{ $storey->id }}&section_id={{ $subValue->id }}">
                                                            <i class="icon-edit text-primary"></i> {{ $storey->setting_title ?? NULL }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>


                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                @else
                    <li class="list-group-item">
                        You have not created any list for this section yet.
                    </li>
                @endif
                </tbody>
            </table>
        </div>
    @endslot
@endcomponent
