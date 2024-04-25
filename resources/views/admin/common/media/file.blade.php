@extends('admin.layouts.master')

@section('title', 'Manage Files')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 mb-4 text-center">
               <div class="row justify-content-center">
                   <div class="col-lg-3">
                       <form method="post" enctype="multipart/form-data" action="{{route('common_media_file_store')}}">
                           @csrf
                           <div class="form-group">
                               <input required type="file" name="file" id="" class="form-control" style="height: auto; line-height: 35px;">
                           </div>
                           <div class="form-group justify-content-center">
                               <button class="btn btn-primary btn-sm" type="submit">Upload</button>
                           </div>
                       </form>
                   </div>
               </div>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    @php
                       $files =  $Model('Media')::where('file_type', 'LIKE', '%'.'application'. '%')->orderBy('id', 'desc')->paginate(30);
                    @endphp
                    @foreach($files as $file)
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="document danger">
                            <div class="document-body">
                                <i class="fa fa-file-pdf text-primary"></i>
                            </div>
                            <div class="document-footer">
                                <div class="">
                                    <span class="document-name">{{$file->filename}} </span>
                                    <span class="document-description">
                                        {{number_format($file->file_size / 1048576, 2) . ' MB' }}
                                        <a  class="d-inline-block text-primary copy-text" href="javascript:void(0)" data-url="{{url($file->full_size_directory)}}">
                                            <small>Copy url</small>
                                        </a>

                                        <div class="float-end">
                                             {!! $ButtonSet::delete('common_media_file_destroy', $file->id) !!}
                                        </div>
                                    </span>

                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection



@section('cusjs')

<script>
 jQuery(document).ready(function($){
        $('.copy-text').click(function(){
        var copyText = $(this).data('url');
        var TempText = document.createElement("input");
        TempText.value = copyText;
        document.body.appendChild(TempText);
        TempText.select();
        document.execCommand("copy");
        document.body.removeChild(TempText);
        toastr.success('Copied Successfully');
    })
 })
</script>
<style>
    .document {
        background-color: #fff;
        border-radius: 3px;
        border: 1px solid #dce2e9;
    }

    .document .document-body {
        height: 130px;
        text-align: center;
        border-radius: 3px 3px 0 0;
        background-color: #fdfdfe;
    }

    .document .document-body i {
        font-size: 45px;
        line-height: 120px;
    }

    .document .document-body img {
        width: 100%;
        height: 100%;
    }

    .document .document-footer {
        border-top: 1px solid #ebf1f5;
        height: 46px;;
        padding: 5px 12px;
        border-radius: 0 0 2px 2px;
        position: relative;
    }

    .document .document-footer .document-name {
        display: block;
        margin-bottom: 0;
        font-size: 11px;
        font-weight: 600;
        width: 100%;
        line-height: normal;
        overflow-x: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        color: #2a2828;
    }

    .document .document-footer .document-description {
        display: block;
        margin-top: -1px;
        font-size: 11px;
        font-weight: 600;
        color: #212020;
        width: 100%;
        line-height: normal;
        overflow-x: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
    .document .file-download {
        font-size: 32px;
        color: #171616;
        position: absolute;
        right: 10px;
    }
    .document.danger .document-footer {
        background-color: #efeeee;
    }
</style>
@endsection
