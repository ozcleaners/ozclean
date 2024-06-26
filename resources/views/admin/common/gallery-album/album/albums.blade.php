@extends('admin.layouts.master')
@section('title', 'Album')
@section('sub_title', 'all image albums')
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
            <div class="col-md-5" id="signupForm">
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
                        {{!empty($album->id) ? route('common_album_update',$album->id) : route('common_album_store') }}
                    @endslot

                    @slot('method')
                        @if (!empty($album->id))
                            {{ method_field('put') }}
                        @endif
                    @endslot

                    @slot('fields')

                        @if (!empty($album->id))
                            {{ Form::hidden('album_id', $album->id, ['required']) }}
                        @endif

                        <div class="form-group">
                            {{ Form::label('album_name', 'Album Name', array('class' => 'album_name')) }}
                            {{ Form::text('album_name', (!empty($album->name) ? $album->name : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'Enter album name...']) }}
                        </div>
                        <div class="form-group">
                            <label for="parent_album">Select Parent Album</label>
                            @php
                                    $albumPcat = $Query::accessModel('AlbumsPcat')::get();
                            @endphp
                            <select name="albums_pcat_id" id="parent_album" class="form-control">
                                @foreach($albumPcat as $data)
                                    <option value="{{ $data['id'] }}">{{ $data['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            {{ Form::label('album_content', 'Album Content', array('class' => 'album_content')) }}
                            {{ Form::textarea('album_content', (!empty($album->description) ? $album->description : NULL), ['required', 'class' => 'form-control', 'id' => 'swysiwyg', 'placeholder' => 'Enter album content...']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('album_css_class', 'Album CSS Class', array('class' => 'album_css_class')) }}
                            {{ Form::text('album_css_class', (!empty($album->cssclass) ? $album->cssclass : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'Enter album css class. Use space for multiple class...']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('album_id', 'Album CSS ID', array('class' => 'album_id')) }}
                            {{ Form::text('album_id', (!empty($album->cssid) ? $album->cssid : NULL), ['class' => 'form-control', 'placeholder' => 'Enter album single css ID...']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('album_position', 'Album Position', array('class' => 'album_position')) }}

                            @if (!empty($album->id))
                                <?php $position = $album->position; ?>
                            @else
                                <?php
                                    $position = $Query::accessModel('Album')::orderBy('id', 'desc')->get()->first();
                                    $position = !empty($position->id) ? $position->id + 1 : 1;
                                ?>
                            @endif

                            {{ Form::text('album_position', (!empty($position) ? $position : NULL), ['class' => 'form-control', 'placeholder' => 'Enter album name...', 'readonly' => true]) }}
                        </div>
                        <div class="form-group">
                            <?php //dump($album); ?>
                            {{ Form::label('is_active', 'Will it be Active?', array('class' => 'is_active')) }}
                            {{ Form::select('is_active', ['1' => 'True', '0' => 'False'], (!empty($album->is_active) && $album->is_active == 1 ? $album->is_active : 0), ['class' => 'form-control', 'placeholder' => 'Will it be active...']) }}
                        </div>

                    @endslot
                @endcomponent
            </div>
            <div class="col-md-7">

                <div class="card">
                    <h6 class="title-with-border p-2">
                        Albums
                        <div class="btn-group btn-group-sm d-inline-block float-end valign-text-bottom me-2"
                             role="group" aria-label="...">
                            <a type="button" class="btn btn-success" href="{{ route('common_album_index') }}">
                                <span class="icon-plus"></span>
                            </a>
                        </div>
                    </h6>
                    <div class="card-body" style="padding: 0.5rem 1rem;">
                        <div class="box-body table-responsive no-padding" id="reload_me">
                            <table class="table table-hover" id="for_reloader">
                                <tr>
                                    <th>Serial No</th>
                                    <th>Name</th>
                                    <th>&nbsp;</th>
                                    <th>Description</th>
                                    <th>Parent Album</th>
{{--                                    <th>CSS ID</th>--}}
{{--                                    <th>CSS CLASS</th>--}}
                                    <th>Position</th>
                                    <th>Status</th>
                                    <th style="width: 60px;">Action</th>
                                </tr>
                                <tbody id="myTable">
                                @foreach($albums as $gal)
                                    @php
                                        $albumPhotoCount = $Query::accessModel('Gallery')::where('category_id', $gal->id)->count();
                                    @endphp
                                    <tr class="item" data-id="{{$gal->id}}">
                                        <td class="index">
                                            {{$gal->id}}
                                        </td>
                                        <td class="index position-relative">
                                            {{ $gal->name }}
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                {{ $albumPhotoCount }}
                                            </span>
                                        </td>
                                        <td>
                                            &nbsp;
                                        </td>
                                        <td>{{ $gal->description }}</td>
                                        <td>
                                            @php
                                                $getAlbumPcat = $Query::accessModel('AlbumsPcat')::where('id', $gal->albums_pcat_id)->get();
                                            @endphp
                                            @if(!empty($gal->albums_pcat_id))
                                                {{ $getAlbumPcat[0]->name }}
                                            @endif

                                        </td>
{{--                                        <td>{{ $gal->cssid }}</td>--}}
{{--                                        <td>{{ $gal->cssclass }}</td>--}}
                                        <td>{{ $gal->special }}</td>
                                        <td>
                                            @if($gal->is_active??false)
                                                Active
                                            @else
                                                Disable
                                            @endif
                                        </td>
                                        <td>
                                            <a class="d-inline" href="{{ route('common_album_index')  }}?id={{$gal->id}}">
                                                <i class="icon-eye"></i>
                                            </a>
                                            <a class="d-inline text-danger"
                                               href="{{ route('common_album_delete',$gal->id)  }}">
                                                <i class="icon-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>


                            <div class="box-footer clearfix">
                                {{ $albums->links('components.paginator', ['object' => $albums]) }}
                            </div>
                        </div>
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

                {{--jQuery.ajax({--}}
                {{--    data: {--}}
                {{--        "_token": "{{ csrf_token() }}",--}}
                {{--        "item": item--}}
                {{--    },--}}
                {{--    type: 'POST',--}}
                {{--    url: '{{ route('admin.common.album.serialupdate') }}',--}}
                {{--    success: function (result) {--}}
                {{--        // jQuery('#reload_me').load('{{ route('admin.common.album.index') }}' + " " + '#reload_me');--}}
                {{--        location.reload(true);--}}
                {{--        jQuery('#myTable').sortable();--}}
                {{--    }--}}
                {{--});--}}
            }
        });
    </script>
    <style>
        td:hover {
            cursor: move;
        }
    </style>
@endpush
