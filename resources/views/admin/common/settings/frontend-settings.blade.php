@extends('admin.layouts.master')

@section('title', 'Frontend Settings')

@section('content')
    <?php
    $frontendSettingRow = function () use ($Query) {
        return $Query::accessModel('FrontendSettings')::orderBy('meta_group', 'ASC')->get()->groupBy('meta_group');
    };

    $frontSetting = function ($arg) use ($Query) {
        $get = $Query::accessModel('FrontendSettings')::where('meta_name', $arg)->first();
        return $get->meta_value ?? NULL;
    }

    ?>

    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-8">
                @if(request()->get('action') == 'AddOption')
                    <div class="card">
                        <form action="{{route('common_setting_frontend_settings_store')}}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <a href="{{ route('common_setting_frontend_settings_index') }}?action=1"
                                   class="btn-outline-secondary btn btn-sm float-end">
                                    Cancel
                                </a>
                                Setting Option
                            </div>
                            <div class="card-body">


                                <div class="form-group">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control form-control-sm"/>
                                </div>

                                <div class="form-group">
                                    <label for="meta_value">Meta Value</label>
                                    <input type="text" name="meta_value" class="form-control form-control-sm"/>
                                </div>

                                <div class="form-group">
                                    <label for="meta_type">Meta Type</label>
                                    <select class="form-select" name="meta_type">
                                        @php
                                            $options = $Query::getEnumValues('frontend_settings', 'meta_type');
                                        @endphp
                                        @foreach($options as $row)
                                            <option value="{{ $row }}">{{ $row }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="meta_group">Meta Group</label>
                                    <select class="form-select" name="meta_group">
                                        @foreach($frontendSettingRow() as $index => $row)
                                            <option value="{{ $index }}">{{ $index }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="" class="images">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-sm py-0">Save changes
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                @else
                    <form action="{{route('common_setting_frontend_settings_update')}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            @php
                                $i = 0;
                            @endphp
                            @foreach( $frontendSettingRow() as $index => $row)
                                @php
                                    $i++;
                                @endphp
                                <div class="col-md-12">
                                    @if(request()->get('action') == $i)
                                        <div class="card">
                                            <div class="card-header card-info py-1">
                                                <a href="{{ route('common_setting_frontend_settings_index') }}?action=AddOption"
                                                   class="btn-outline-secondary btn btn-sm float-end">
                                                    Add New Option
                                                </a>
                                                <h3 class="card-title panel-title float-left mb-1"
                                                    style="font-size: 19px;">
                                                    {{ !empty($index) ? $index : 'Default' }} Settings
                                                </h3>
                                            </div><!-- end card-header-->


                                            <div class="div card-body">
                                                @foreach ($row as $key => $item)
                                                    <div class="form-group">
                                                        <h6 style="margin-bottom: 5px; font-size: 7px; color: #a3a3a3;">{{ $item->meta_title }}</h6>
                                                    </div>
                                                    <div class="form-group">
                                                        <input name="meta_title[{{$key}}]"
                                                               value="{{ $item->meta_title ?? NULL }}"
                                                               class="form-control form-control form-control-sm w-50"
                                                               style="margin-right: 20px;"/>
                                                        <select name="meta_group[{{$key}}]" id="" class="me-3">
                                                            @foreach($frontendSettingRow() as $indexGroup => $row)
                                                                <option value="{{ $indexGroup }}"
                                                                    {{$indexGroup == $item->meta_group ? 'selected' : null}}
                                                                >
                                                                    {{ $indexGroup }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        <input name="meta_name[]" type="hidden"
                                                               value="{{$item->meta_name}}">

                                                        @if($item->meta_type == 'Text')
                                                            <input name="{{$item->meta_name}}" type="text"
                                                                   class="form-control form-control-sm"
                                                                   value="{{$frontSetting($item->meta_name) }}"
                                                                   placeholder="{{$frontSetting($item->meta_placeholder) }}">
                                                        @endif

                                                        @if($item->meta_type == 'Textarea')
                                                            <textarea name="{{$item->meta_name}}"
                                                                      class="form-control form-control-sm">{{$frontSetting($item->meta_name) }}</textarea>
                                                        @endif

                                                        @if($item->meta_type == 'Number')
                                                            <input name="{{$item->meta_name}}" type="number"
                                                                   class="form-control form-control-sm"
                                                                   value="{{$frontSetting($item->meta_name) }}"
                                                                   placeholder="{{$frontSetting($item->meta_placeholder) }}">
                                                        @endif

                                                        @if($item->meta_type == 'Email')
                                                            <input name="{{$item->meta_name}}" type="email"
                                                                   class="form-control form-control-sm"
                                                                   value="{{$frontSetting($item->meta_name) }}"
                                                                   placeholder="{{$frontSetting($item->meta_placeholder) }}">
                                                        @endif

                                                    </div>
                                                @endforeach

                                                <div class="form-group mt-2">
                                                    <button type="submit" class="btn btn-primary btn-sm py-0">
                                                        Save changes
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </form>
                @endif
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        List of frontend settings
                    </div>
                    <div class="card-body">
                        @php
                            $i = 0;
                        @endphp
                        @foreach( $frontendSettingRow() as $index => $row)
                            @php
                                $i++;
                            @endphp
                            <ul class="list-group">
                                <li class="list-group-item mb-2">
                                    <a class="text-primary"
                                       href="{{ route('common_setting_frontend_settings_index') }}?action={{ $i  }}">
                                        @if(!empty($index))
                                            {{ $index }}
                                        @else
                                            Default
                                        @endif
                                        Settings
                                    </a>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('cusjs')
@endsection
