@extends('admin.layouts.master')

@section('title', 'Medias')

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
            <div class="col-md-12" id="signupForm">
                @component('components.dropzone')
                @endcomponent
            </div>
                <div class="row">
                    <br/>
                </div>
            <div class="col-md-12">
                <h6>
                    <div class="title">
                        <div class="d-inline-block float-end valign-text-bottom me-2">
                            {{ Form::open(array(
                                'url' => 'admin/medias',
                                'method' => 'get',
                                'value' => 'PATCH',
                                'id' => '',
                                'files' => true,
                                'autocomplete' => 'off'
                            )) }}
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="q" class="form-control pull-right mb-0"
                                       placeholder="Search" value="<?php echo Request::get('s'); ?>">
                                <button type="submit" class="btn btn-sm p-0 position-absolute end-0"><span
                                        class="icon-search"></span></button>
                            </div>
                            {{ Form::close() }}
                        </div>
                        Medias
                    </div>
                </h6>
                <br>
                <div class="card">
                    <div class="card-bodyx">
                        <!-- /.box-header -->
                        <div class="table table-wrapper desktop-view mobile-view" id="reload_me">
                            <table class="table table-hover dataTable no-footer">
                                <thead style="position: sticky;top:-1px;">
                                <tr>
                                    <th style="max-width: 100px;"></th>
                                    <th>ID</th>
                                    <th title="File Name, Type, Extension, Uploader Name, Status, Uploaded Date">
                                        File Name & Others
                                    </th>
                                    <th>Directory</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($medias as $media)
                                    <tr>
                                        <td>
                                            <img class="img-fluid" style="max-width: 100px; max-height: 100px;"
                                                 src="{{ url($media->icon_size_directory) }}"/>
                                        </td>
                                        <td>{{ $media->id }}</td>
                                        <td>

                                            <b title="File Name">File Name: </b>
                                            {{ $media->filename }}

                                            <br/>

                                            <b title="File Name">File Type: </b>
                                            {{ $media->file_type }} ||

                                            <b title="Status">Status: </b>
                                            @if($media->status == 1)
                                                <span class="label label-success">Active</span>
                                            @else
                                                <span class="label label-default">Deactive</span>
                                            @endif


                                            <br/>

                                            <b title="Status">Uploader: </b>
                                            {{ $media->user->name }}

                                            <br/>

                                            <b title="Status">Uploaded: </b>
                                            {{ $media->created_at }}


                                        </td>

                                        <td>

                                            <i class="fa fa-camera-retro fa-lg d-inline-block text-dark"
                                               title="Full Size"></i>
                                            <input
                                                type="text"
                                                title="Full Size"
                                                onClick="this.setSelectionRange(0, this.value.length)"
                                                value="{{ url($media->full_size_directory) }}"/>

                                            <br/><br/>

                                            <i class="fa fa-compress fa-lg d-inline-block text-dark"
                                               title="Thumbnail Size"></i>
                                            <input
                                                type="text"
                                                title="Thumbnail Size"
                                                onClick="this.setSelectionRange(0, this.value.length)"
                                                value="{{ url($media->icon_size_directory) }}"/>

                                        </td>

                                        <td>
                                            {{ Form::open(['method' => 'delete', 'route' => ['common_media_destroy', $media->id], 'class' => '']) }}
                                            {{ Form::button('<i class="fa fa-trash d-inline-block text-danger"></i>', array('type' => 'submit', 'class' => 'btn btn-sm border-0')) }}
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="box-footer clearfix">
                                {{ $medias->links('components.paginator', ['object' => $medias]) }}
                            </div>
                            <!-- /.pagination pagination-sm no-margin pull-right -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('cusjs')
    <script src="{{ $publicDir }}/js/dropzone.js"></script>
    <script src="{{ $publicDir }}/js/dropzone-config.js"></script>
    <link rel="stylesheet" href="{{ $publicDir }}/css/dropzone.min.css">
@endsection

