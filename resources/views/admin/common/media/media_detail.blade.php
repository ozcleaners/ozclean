@extends('admin.layouts.master')

@section('title', 'Media Detail')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6" style="overflow: hidden">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item text-center">
                                    <img class="" style=""
                                         src="{{ url($media->full_size_directory) }}"/>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <b title="File Name">File Name: </b>
                                    {{ $media->filename }}
                                </li>
                                <li class="list-group-item">
                                    <b title="File Name">File Type: </b>
                                    {{ $media->file_type }}
                                </li>
                                <li class="list-group-item">
                                    <b title="Status">File Usable Status: </b>
                                    @if($media->status == 1)
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-default">Deactive</span>
                                    @endif
                                </li>
                                <li class="list-group-item">
                                    <b title="Status">Uploader: </b>
                                    {{ $media->user->name }}
                                </li>
                                <li class="list-group-item">
                                    <b title="Status">Uploaded: </b>
                                    {{ $media->created_at }}
                                </li>
                                <li class="list-group-item">
                                    <b title="Status">Full Size: </b>
                                    <input
                                        class="form-control"
                                        type="text"
                                        title="Full Size"
                                        onClick="this.setSelectionRange(0, this.value.length)"
                                        value="{{ url($media->full_size_directory) }}"/>
                                </li>
                                <li class="list-group-item">
                                    <b title="Status">Thumbnail Size: </b>
                                    <input
                                        class="form-control"
                                        type="text"
                                        title="Thumbnail Size"
                                        onClick="this.setSelectionRange(0, this.value.length)"
                                        value="{{ url($media->icon_size_directory) }}"/>
                                </li>

                                <li class="list-group-item">
                                    <a href="{{ route('common_media_index') }}" class="btn btn-sm btn-primary">Go back
                                        to
                                        media</a>
                                </li>
                                <li class="list-group-item">
                                    {{ Form::open(['method' => 'delete', 'route' => ['common_media_destroy', $media->id], 'class' => '']) }}
                                    {{ Form::button('<i class="fa fa-trash d-inline-block text-danger"></i> Delete Permanently', array('type' => 'submit', 'onclick' => 'return confirm(\'Are you sure?\')', 'class' => 'btn btn-sm border-0')) }}
                                    {{ Form::close() }}
                                </li>
                            </ul>
                        </div>
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

