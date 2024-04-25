@extends('admin.layouts.master')
@section('title', 'Gallery')
@section('sub_title', 'all images')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            @if(Session::has('success'))
                <div class="col-md-12">
                    <div class="callout callout-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="col-md-12">
                    <div class="callout callout-danger">
                        <h4>Warning!</h4>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
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

                        <div class="form-group">
                            {{ Form::label('imageId', 'Image ID', array('class' => 'imageId')) }}
                            {{ Form::hidden('gallery_for', 'General') }}
                            {{ Form::text('imageId', $image->media_id??'', ['required', 'class' => 'form-control', 'placeholder' => 'Enter ID...']) }}
                            {{--                            @if($image->image??false)--}}
                            {{--                                @php--}}
                            {{--                                    $img = $Query::accessModel('Media')::where('id', $image->image)->first();--}}
                            {{--                                @endphp--}}
                            {{--                                <div><img src="{{ asset($img->icon_size_directory) }}" width="80"/></div>--}}
                            {{--                            @endif--}}
                        </div>

                        <div class="form-group">
                            {{ Form::label('caption', 'Caption', array('class' => 'uri')) }}
                            {{ Form::textarea('caption', $image->caption ?? '', ['', 'class' => 'form-control', 'placeholder' => 'Enter caption...']) }}
                        </div>

                        <div class="form-group">
                            {{Form::label('album','Album',array('class' => 'album'))}}
                            <?php
                            $albums = $Query::accessModel('Album')::select('id', 'name')->get();
                            ?>
                            <select class="form-control" name="album_id">
                                @foreach($albums as $album)
                                    <option
                                        value="{{ $album->id }}" {{ (!empty($image->category_id) && $image->category_id == $album->id) ? 'selected="selected"' : '' }}>
                                        {{ $album->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            {{Form::label('status','Status',array('class' => 'status'))}}
                            {!! Form::select('active', [0 => 'Disable', 1 => 'Active'], $image->active??1,['class' => 'form-control']) !!}
                        </div>

                    @endslot
                @endcomponent
            </div>
            <div class="col-md-8">

                <div class="card">
                    <h6 class="title-with-border p-2">
                        Gallery Images
                        <div class="btn-group btn-group-sm d-inline-block float-end valign-text-bottom me-2"
                             role="group" aria-label="...">
                            <a type="button" class="btn btn-success" href="{{ route('common_gallery_index') }}">
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
                                    @endphp
                                    <tr class="item" data-id="{{ $gal->id }}">
                                        <td>
                                            <div style="max-height: 50px; overflow: hidden">
                                                <img title="{{ $img->original_name??'' }}"
                                                     src="{{ asset(($img->icon_size_directory??'')) }}" width="50"/>
                                            </div>
                                        </td>
                                        <td>{{ $gal->caption??'' }}</td>
                                        <td>
                                            @php
                                                $albumName = $Query::accessModel('Album')::where('id', $gal->category_id)->get();
                                            @endphp
                                            @if(!empty($albumName[0]))
                                                {{$albumName[0]->name}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($gal->active??false)
                                                Active
                                            @else
                                                Disable
                                            @endif
                                        </td>
                                        <td>
                                            <a class="d-inline"
                                               href="{{ route('common_gallery_index')  }}?id={{$gal->id}}">
                                                <i class="icon-eye"></i>
                                            </a>
                                            <a class="d-inline text-danger"
                                               href="{{ route('common_gallery_delete',$gal->id)  }}">
                                                <i class="icon-trash"></i>
                                            </a>
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
