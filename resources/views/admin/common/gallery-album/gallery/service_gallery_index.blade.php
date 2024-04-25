@extends('admin.layouts.master')
@section('title', 'Gallery')
@section('sub_title', 'all images')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-4" id="signupForm">
                @component('components.form')
                    @slot('form_id')
                        @if (!empty($image->id))
                            schedule_form333
                        @else
                            schedule_form333
                        @endif
                    @endslot
                    @slot('title')
                        Add/Edit
                    @endslot

                    @slot('route')
                        {{!empty($image->id)?route('common_gallery_update',$image->id):route('common_gallery_store')}}
                    @endslot

                    @slot('method')
                        {{-- @if (!empty($team->id))
                            {{ method_field('put') }}
                        @endif --}}
                    @endslot

                    @slot('fields')
                        @php
                            if($image) {
                                $parent_id = $Term::where('id', $image->category_id)->first()->parent;
                            }
                        @endphp

                        <div class="form-group">
                            {{ Form::label('parent_service_name','Parent Service',array('class' => 'album')) }}
                            @php
                                $parent_services = $Term::where('parent', 3)->select('id', 'name')->get();
                                $parentCatId = [];
                            @endphp
                            <select name="parent_category_id" class="form-control" id="parent_service" required>
                                @foreach($parent_services as $service)
                                    @php
                                        $parentCatId []= $service->id;
                                    @endphp
                                    <option
                                        value="{{ $service->id }}" {{ (!empty($parent_id) && $service->id == $parent_id) ? 'selected="selected"' : '' }}>
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            @php
                                $subService = $Term::whereIn('parent', array_values($parentCatId))->select('id', 'parent', 'name')->get();
                                //dump($subService);
                                //dump();
                            @endphp
                            {{Form::label('album','Sub Service',array('class' => 'album'))}}
                            <?php
                            $albums = $Query::accessModel('Album')::select('id', 'name')->get();
                            ?>
                            <select class="form-control" id="subService" name="album_id" required>

                            </select>
                        </div>
                        <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
                            @component('components.media_manager_template', [ 'media_array' => [
                                    'button_id' => 'imageId',
                                    'label' => 'Image',
                                    'input_name' => 'media_id',
                                    'row_information' => $image ?? NULL,
                                    'script_load' => TRUE
                                    ]])
                            @endcomponent
                        </div>

                        <div class="form-group">
                            {{ Form::label('caption', 'Caption', array('class' => 'uri')) }}
                            {{ Form::textarea('caption', $image->caption ?? '', ['', 'class' => 'form-control', 'placeholder' => 'Enter caption...']) }}
                        </div>

                        <div class="form-group">
                            {{Form::label('status','Status',array('class' => 'status'))}}
                            {!! Form::select('active', [0 => 'Disable', 1 => 'Active'], $image->active??1,['class' => 'form-control']) !!}
                        </div>
                        <input type="hidden" name="gallery_for" value="Service">
                    @endslot
                @endcomponent
            </div>
            <div class="col-md-8">

                <div class="card">
                    <h6 class="title-with-border p-2">
                        Gallery Images
                        <div class="btn-group btn-group-sm d-inline-block float-end valign-text-bottom me-2"
                             role="group" aria-label="...">
                            <a type="button" class="btn btn-success" href="{{ route('common_service_gallery_index') }}">
                                <span class="icon-plus"></span>
                            </a>
                        </div>
                    </h6>
                    <div class="card-body" style="padding: 0.5rem 1rem;">
                        <div class="box-body table-responsive no-padding" id="reload_me">
                            <table class="table table-hover" id="for_reloader">
                                <tr>
                                    <th>Image</th>
                                    <th>Caption</th>
                                    <th>Album</th>
                                    <th>Status</th>
                                    <th style="width: 60px;">Action</th>
                                </tr>
                                <tbody id="myTable">
                                @foreach($gallery as $gal)
                                    @php
                                        $img = $Query::accessModel('Media')::where('id', $gal->media_id)->first();
                                        $parent = $Query::accessModel('Term')::where('id', $gal->category_id)->first();
                                        $parentId = $parent->parent ?? NULL;
                                        $parentName = $parent->name ?? NULL;
                                        $name = $Query::accessModel('Term')::where('id', $parentId)->first()->name ?? NULL;
                                    @endphp


                                    <tr class="item" data-id="{{ $gal->id }}">
                                        <td>
                                            <div style="max-height: 50px; overflow: hidden">
                                                <img title="{{ $img->original_name??'' }}"
                                                     src="{{ asset(($img->icon_size_directory ?? '')) }}" width="50"/>
                                            </div>
                                        </td>
                                        <td>{{ $gal->caption ?? '' }}</td>
                                        <td>
                                            <b>{{ $parentName ?? NULL }}</b>
                                            <br/> under {{ $name ?? NULL }}
                                        </td>
                                        <td>
                                            @if($gal->active ?? false)
                                                Active
                                            @else
                                                Disable
                                            @endif
                                        </td>
                                        <td>
                                            <a class="d-inline"
                                               href="{{ route('common_service_gallery_index')  }}?id={{$gal->id}}">
                                                <i class="icon-edit"></i>
                                            </a>
                                            {!! $ButtonSet::delete('common_gallery_delete', $gal->id) !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>


                            <div class="box-footer clearfix">
                                {{ $gallery->links('components.paginator', ['object' => $gallery]) }}
                            </div>
                        </div>

                    </div>
                    <div class="box-footer clearfix">
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection



@section('cusjs')
    <script>
        jQuery(document).ready(function ($) {
            $.noConflict();

            $('select#parent_service').change(function (e) {
                e.preventDefault()
                let getValue = $(this).find(':selected').val();
                //alert($getValue);
                $('select#subService').empty().append(loadSubService(getValue));
            })

            let ifParent = '<?php echo $parent_id ?? null; ?>';
            if (ifParent) {
                $('select#subService').empty().append(loadSubService(ifParent, '{{$image->category_id ?? null}}'));
            }

            function loadSubService(id, subId = null) {
                //console.log(subId);
                let html = `@foreach($subService as $items)`;

                if (id == '{{$items->parent}}') {

                    html += '<option value="{{$items->id}}"';
                    if ('{{$items->id}}' == subId) {
                        html += 'selected';
                    }
                    html += '>{{$items->name}}';
                    html += '</option>';
                }


                <?php echo $items->id == '+subId+' ? 'selected' : '';?>

                    html += `@endforeach
                `;
                return html;
            }


        });
    </script>


@endsection


@push('scripts')
    <script type="text/javascript">
        jQuery('#myTable').sortable({
            axis: 'y',
            update: function (event, ui) {
                var data = jQuery(".item"),
                    item = []


                jQuery.each(data, function (index, itm) {
                    var autoid = itm.dataset.id;
                    var serial = index + 1;

                    item.push({
                        serial: serial,
                        id: autoid
                    });

                    //console.log(jQuery(itm)[0])
                });

                jQuery.ajax({
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "item": item
                    },
                    type: 'POST',
                    url: '{{ route('common_gallery_serialupdate') }}',
                    success: function (result) {

                        location.reload(true);
                        jQuery('#myTable').sortable();
                    }
                });
            }
        });
    </script>
    <style>
        td:hover {
            cursor: move;
        }
    </style>

@endpush
