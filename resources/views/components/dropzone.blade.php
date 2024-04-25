@php
    $default = [
        'scriptLoad' => true,
        'paginate' => true,
        'unique_class' => null,
    ];
    $arrMerge = array_merge($default, $mediaArr ?? []);
@endphp
<div class="col-md-12" id="signupForm">
    <div class='content'>
        <!-- Dropzone -->
        {!! Form::open(['url' => route('common_media_store'), 'id' => 'real-dropzone', 'class' => 'dropzone', 'files'=> true]) !!}
        <div class="dz-message"></div>
        <div class="fallback">
            <input name="file" type="file" multiple/>
        </div>
        <div class="dropzone-previews" id="dropzonePreview"></div>
        <h4 style="text-align: center;color:#428bca;">
            Drop images in this area
            <span class="glyphicon glyphicon-hand-down"></span>
        </h4>
        {!! Form::close() !!}
    </div>
</div>
<div class="row">
    <br/>
</div>
<div class="col-md-12">
    <h6>
        <div class="title">
            <div class="d-inline-block float-end media_manager_search valign-text-bottom me-2">
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
                    <button type="submit" class="btn btn-sm p-0 position-absolute end-0">
                        <span class="icon-search"></span>
                    </button>
                </div>
                {{ Form::close() }}
            </div>
            Medias
        </div>
    </h6>
    <br>
    <div id="reload_me">
        <div class="card">
            <div class="card-body" style="padding: 0.5rem 1rem;">
                <div class="row">
                    <ul class="wp-like">
                        @php
                            $medias = $Media::with('user')->orderBy('id', 'DESC')->paginate('44')
                        @endphp
                        @foreach($medias as $media)
                            <li class="attachment">
                                @php
                                    $isLandscape = $Media::isLandsape($media->icon_size_directory);
                                @endphp


                                <a href="{{ route('common_media_detail', $media->id) }}"
                                   class="mediaManagerCheckedMedia"
                                   data-link="<?php echo url(url($media->icon_size_directory)); ?>"
                                   data-id="<?php echo $media->id; ?>"
                                >
                                    <div
                                        class="attachment-preview {{ ($isLandscape == true) ? 'landscape' : 'portrait' }}">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img src="{{ url($media->icon_size_directory) }}"/>

                                            </div>
                                        </div>
                                        <span class="onHoverShowSpan" style="display: none;">
                                            {{ $media->filename }}
                                        </span>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @if($arrMerge['paginate'] == true)
                    <div class="row">
                        {{ $medias->links('components.paginator', ['object' => $medias]) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
