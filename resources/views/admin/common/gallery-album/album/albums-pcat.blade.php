@extends('admin.layouts.master')
@section('title', 'Parent Album')
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
                        {{!empty($albumPcat->id) ? route('common_album_pcat_update',$albumPcat->id) : route('common_album_pcat_store') }}
                    @endslot

                    @slot('method')
                        @if (!empty($albumPcat->id))
                            {{ method_field('put') }}
                        @endif
                    @endslot

                    @slot('fields')

                        @if (!empty($albumPcat->id))
                            {{ Form::hidden('album_id', $albumPcat->id, ['required']) }}
                        @endif

                        <div class="form-group">
                            {{ Form::label('album_pcat_name', 'Parent Album Name', array('class' => 'album_pcat_name')) }}
                            {{ Form::text('album_pcat_name', (!empty($albumPcat->name) ? $albumPcat->name : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'Enter parent album name...']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('cover_photo', 'Cover Photo', array('class' => 'cover_photo')) }}
                            {{ Form::text('cover_photo', (!empty($albumPcat->cover_photo) ? $albumPcat->cover_photo : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'Enter parent cover photo...']) }}
                        </div>
                        <div class="form-group">
                            <?php //dump($album); ?>
                            {{ Form::label('is_active', 'Will it be Active?', array('class' => 'is_active')) }}
                            {{ Form::select('is_active', ['1' => 'True', '0' => 'False'], (!empty($albumPcat->is_active) && $albumPcat->is_active == 1 ? $albumPcat->is_active : 0), ['class' => 'form-control', 'placeholder' => 'Will it be active...']) }}
                        </div>

                    @endslot
                @endcomponent
            </div>
            <div class="col-md-7">
                <div class="card">
                    <h6 class="title-with-border p-2">
                        Parent Albums
                        <div class="btn-group btn-group-sm d-inline-block float-end valign-text-bottom me-2"
                             role="group" aria-label="...">
                            <a type="button" class="btn btn-success" href="{{route('common_album_pcat_index')}}">
                                <span class="icon-plus"></span>
                            </a>
                        </div>
                    </h6>
                    <div class="card-body" style="padding: 0.5rem 1rem;">
                        <div class="box-body table-responsive no-padding" id="reload_me">
                            <table class="table table-hover" id="for_reloader">
                                <tr>
                                    {{--                                    <th>Serial No</th>--}}
                                    <th>Name</th>
                                    <th>Cover Photo</th>
                                    <th>Status</th>
                                    <th style="width: 60px;">Action</th>
                                </tr>
                                <tbody id="myTable">
                                @foreach($albumsPcat as $gal)
                                    <tr class="item" data-id="{{$gal->id}}">
                                        {{--                                        <td class="index">{{$gal->id}} </td>--}}
                                        <td class="index">{{$gal->name}} </td>
                                        <td class="index">
                                            <img src="{{ $Media::fullSize($gal->cover_photo) }}"
                                                 style="max-width: 60px;"/>
                                        </td>
                                        <td>
                                            @if($gal->is_active??false)
                                                Active
                                            @else
                                                Disable
                                            @endif
                                        </td>
                                        <td>
                                            <a class="d-inline"
                                               href="{{ route('common_album_pcat_index')  }}?id={{$gal->id}}">
                                                <i class="icon-eye"></i>
                                            </a>
                                            <a class="d-inline text-danger"
                                               href="{{ route('common_album_pcat_delete',$gal->id)  }}">
                                                <i class="icon-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>


                            <div class="box-footer clearfix">
                                {{ $albumsPcat->links('components.paginator', ['object' => $albumsPcat]) }}
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

                {{--jQuery.ajax({--}}
                {{--    data: {--}}
                {{--        "_token": "{{ csrf_token() }}",--}}
                {{--        "item": item--}}
                {{--    },--}}
                {{--    type: 'POST',--}}
                {{--    url: '{{ route('admin.common.album.pcat.serialupdate') }}',--}}
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
