@extends('admin.layouts.master')

@section('title', 'Posts')

@section('content')

@if(request()->get('which_editor') == 'grapes')
    <div class="content-wrapper">
        <div id="gjs" style="height:0px; overflow:hidden;">            
        </div>
    </div>
@else
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

            <div class="col-md-8">
                @component('component.form')
                    @slot('form_id')
                        @if (!empty($user->id))
                            page_forms
                        @else
                            page_form
                        @endif
                    @endslot

                    @slot('title')
                        @if (!empty($page->id))
                        Edit page
                        @else
                        Add a new page
                        @endif
                    @endslot

                @slot('route')
                    @if (!empty($page->id))
                        {{ route('common_page_update', $page->id) }}
                    @else
                        {{ route('common_page_store') }}
                    @endif
                @endslot

                @slot('method')
                    @if (!empty($page->id))
                        {{method_field('POST')}}
                    @endif
                @endslot
                
                @slot('fields')
                {{ Form::hidden('user_id', (!empty(\Auth::user()->id) ? \Auth::user()->id : NULL), ['type' => 'hidden']) }}
                {{ Form::hidden('lang', (!empty($page->lang) ? $page->lang : 'en'), ['type' => 'hidden']) }}
                {{ Form::hidden('page_id', (!empty($page->id) ? $page->id : ''), ['type' => 'hidden']) }}
                <div class="form-group mb-3">                                        
                    {{ Form::label('which_editor', 'Which editor?', array('class' => 'which_editor')) }}
                        <div class="form-check d-inline-block">
                            <label class="radio-inline">
                            {{ Form::radio('which_editor', 'normal', (!empty($page) ? (($page->which_editor == 'normal') ? 'normal' : '') : ''), ['class' => 'radio']) }}                                
                                <img width="200px" style="border: 1px solid #DDD; padding: 5px;" src="{{ $publicDir }}/images/normal.png" />
                            </label>
                            <label class="radio-inline">
                            {{ Form::radio('which_editor', 'grapes', (!empty($page) ? (($page->which_editor == 'grapes') ? 'grapes' : '') : ''), ['class' => 'radio', 'required']) }}
                                <img width="200px" style="border: 1px solid #DDD; padding: 5px;" src="{{ $publicDir }}/images/grapes.png" />
                            </label>
                        </div>
                    </div>  
                <div class="form-group">                    
                    {{ Form::label('title', 'Title', array('class' => 'title')) }}
                    {{ Form::text('title', (!empty($page->title) ? $page->title : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'Enter title...']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('sub_title', 'Sub Title', array('class' => 'sub_title')) }}
                    {{ Form::text('sub_title', (!empty($page->sub_title) ? $page->sub_title : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'Enter sub_title...']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('seo_url', 'Search Engine Friendly URL', array('class' => 'seo_url')) }}
                    {{ Form::text('seo_url', (!empty($page->seo_url) ? $page->seo_url : NULL), ['type' => 'text', 'required', 'class' => 'form-control', 'placeholder' => 'Enter seo URL...']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('author', 'Author/Contact Person', array('class' => 'author')) }}
                    {{ Form::text('author', (!empty($post->author) ? $post->author : NULL), ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Enter author...']) }}
                </div>
                @if(!empty($page->which_editor) && $page->which_editor == 'grapes')
                    <div class="form-group mb-2 text-center d-block" style="padding: 30px;border: 1px dashed #ddd;background: #f9f9f9;">
                        <a href="{{ route('common_page_edit', $page->id) }}?which_editor=grapes" class="btn btn-xl btn-success">
                            Edit with grapes
                        </a>
                    </div>                    
                @else
                    <div class="form-group mb-2">
                        {{ Form::label('description', 'Description', array('class' => 'description')) }}
                        {{ Form::textarea('description', (!empty($page->description) ? $page->description : NULL), ['required', 'class' => 'form-control', 'id' => 'wysiwyg', 'placeholder' => 'Enter details content...']) }}
                    </div>
                @endif
                <div class="form-group">
                    {{ Form::label('images', 'Image ID/s', array('class' => 'images')) }}
                    @if(!empty($page->images))
                    <?php
                    // $im = image_ids($page);
                    $im = $page->images;
                    ?>
                    {{ Form::text('images', (!empty($im) ? $im : NULL), ['type' => 'text', 'id' => 'image_ids', 'class' => 'form-control', 'placeholder' => 'Enter image IDs...']) }}
                    @else
                    {{ Form::text('images', NULL, ['type' => 'text', 'id' => 'image_ids', 'class' => 'form-control', 'placeholder' => 'Enter image IDs...']) }}
                    @endif

                    <small id="show_image_names"></small>
                </div>
                                
                <div class="form-group">
                    @if(!empty($page))
                    {{-- {!!  uploaded_photos($page) !!}--}}
                    @endif
                </div>
                <div class="form-group">                                        
                    {{ Form::label('is_sticky', 'Is it sticky?', array('class' => 'is_sticky')) }}

                    <div class="form-check d-inline-block">
                        <label class="radio-inline d-block">
                            {{ Form::radio('is_sticky', 1, ((!empty($page) ? $page->is_sticky == 1 : 1) ? TRUE : FALSE), ['class' => 'radio']) }}
                            Yes. This page will be marked as selected top page
                        </label>
                        <label class="radio-inline  d-block">
                            {{ Form::radio('is_sticky', 0, ((!empty($page) ? $page->is_sticky == 0 : 0) ? TRUE : FALSE), ['class' => 'radio']) }}
                            No. This page will no be marked as selected top page
                        </label>
                    </div>
                </div>

                <div class="form-group">                                        
                {{ Form::label('is_active', 'Will it be active?', array('class' => 'is_active')) }}

                    <div class="form-check d-inline-block">
                        <label class="radio-inline d-block">
                        {{ Form::radio('is_active', 1, (!empty($page) ? (($page->is_active == 1) ? TRUE : FALSE) : TRUE), ['class' => 'radio']) }}
                            Yes. This page will publish
                        </label>
                        <label class="radio-inline  d-block">
                        {{ Form::radio('is_active', 0, (!empty($page) ? (($page->is_active == 0) ? TRUE : FALSE) : null), ['class' => 'radio']) }}
                            No. This page will save as draft
                        </label>
                    </div>
                </div>                                
                <div class="form-group">
                    {{ Form::label('short_description', 'Short Description', array('class' => 'short_description')) }}
                    {{ Form::textarea('short_description', (!empty($page->short_description) ? $page->short_description : NULL), ['class' => 'form-control', 'placeholder' => 'Enter short description...']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('youtube', 'Youtube', array('class' => 'youtube')) }}
                    {{ Form::text('youtube', (!empty($page->youtube) ? $page->youtube : NULL), ['class' => 'form-control', 'placeholder' => 'Enter youtube...']) }}
                </div>
                <div class="form-group">
                    <label>
                        {{ Form::label('h1tag', 'H1 Tag', array('class' => 'h1tag')) }}
                    </label>    
                    {{ Form::text('h1tag', $page->h1tag??'', ['class' => 'form-control', 'placeholder' => 'Enter h1 tag...']) }}
                </div>

                <div class="form-group">
                    <label>
                    {{ Form::label('h2tag', 'H2Tag', array('class' => 'h2tag')) }}
                    </label>
                    {{ Form::text('h2tag', $page->h2tag??'', ['class' => 'form-control', 'placeholder' => 'Enter h2tag...']) }}

                </div>

                <div class="form-group">
                    <label>
                            {{ Form::label('seo_title', 'Seo Title', array('class' => 'seo_title')) }}
                    </label>
                        {{ Form::text('seo_title', $page->seo_title??'', ['class' => 'form-control', 'placeholder' => 'Enter seo title...']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('seo_description', 'Seo Description', array('class' => 'seo_description')) }}
                    {{ Form::textarea('seo_description', (!empty($page->seo_description) ? $page->seo_description : NULL), ['class' => 'form-control', 'placeholder' => 'Enter seo description...']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('seo_keywords', 'Seo Keywords', array('class' => 'seo_keywords')) }}
                    {{ Form::textarea('seo_keywords', (!empty($page->seo_keywords) ? $page->seo_keywords : NULL), ['class' => 'form-control', 'placeholder' => 'Enter short keywords...']) }}
                </div>


                @endslot
                @endcomponent
            </div>
            
        </div>
    </div>
@endif
@endsection

@section('cusjs')
<link rel="stylesheet" href="{{ $publicDir }}/assets/grapes/css/grapes.min.css">
<script src="{{ $publicDir }}/assets/grapes/grapes.min.js"></script>
<script src="https://grapesjs.com/js/grapesjs-preset-webpage.min.js"></script>
<script type="text/javascript">
    var editor  = grapesjs.init({
        avoidInlineStyle: 1,
        height: '100%',
        container : '#gjs',
        fromElement: 1,
        showOffsets: 1,
        assetManager: {
          embedAsBase64: 1,
        //   assets: images
        },
        selectorManager: { componentFirst: true },        
        storageManager: {
            type: 'remote',
            stepsBeforeSave: 0,
            autosave: true, // Store data automatically
            autoload: true,
            urlStore: "{{ route('common_page_grapes_update') }}?id={{ $page->id ?? null }}",
            urlLoad: "{{ route('common_page_grapes_load_now') }}?id={{ $page->id ?? null }}",            
            contentTypeJson: true,
            storeComponents: true,
            storeStyles: true,
            storeHtml: true,
            storeCss: true,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        styleManager: { clearProperties: 1 },
        plugins: [
          'grapesjs-lory-slider',
          'grapesjs-tabs',
          'grapesjs-custom-code',
          'grapesjs-touch',
          'grapesjs-parser-postcss',
          'grapesjs-tooltip',
          'grapesjs-tui-image-editor',
          'grapesjs-typed',
          'grapesjs-style-bg',
          'gjs-preset-webpage',
        ],
        pluginsOpts: {
          'grapesjs-lory-slider': {
            sliderBlock: {
              category: 'Extra'
            }
          },
          'grapesjs-tabs': {
            tabsBlock: {
              category: 'Extra'
            }
          },
          'grapesjs-typed': {
            block: {
              category: 'Extra',
              content: {
                type: 'typed',
                'type-speed': 40,
                strings: [
                  'Text row one',
                  'Text row two',
                  'Text row three',
                ],
              }
            }
          },
          'gjs-preset-webpage': {
            modalImportTitle: 'Import Template',
            modalImportLabel: '<div style="margin-bottom: 10px; font-size: 13px;">Paste here your HTML/CSS and click Import</div>',
            modalImportContent: function(editor) {
              return editor.getHtml() + '<style>'+editor.getCss()+'</style>'
            },
            filestackOpts: null, //{ key: 'AYmqZc2e8RLGLE7TGkX3Hz' },
            aviaryOpts: false,
            blocksBasicOpts: { flexGrid: 1 },
            customStyleManager: [{
              name: 'General',
              buildProps: ['float', 'display', 'position', 'top', 'right', 'left', 'bottom'],
              properties:[{
                  name: 'Alignment',
                  property: 'float',
                  type: 'radio',
                  defaults: 'none',
                  list: [
                    { value: 'none', className: 'fa fa-times'},
                    { value: 'left', className: 'fa fa-align-left'},
                    { value: 'right', className: 'fa fa-align-right'}
                  ],
                },
                { property: 'position', type: 'select'}
              ],
            },{
                name: 'Dimension',
                open: false,
                buildProps: ['width', 'flex-width', 'height', 'max-width', 'min-height', 'margin', 'padding'],
                properties: [{
                  id: 'flex-width',
                  type: 'integer',
                  name: 'Width',
                  units: ['px', '%'],
                  property: 'flex-basis',
                  toRequire: 1,
                },{
                  property: 'margin',
                  properties:[
                    { name: 'Top', property: 'margin-top'},
                    { name: 'Right', property: 'margin-right'},
                    { name: 'Bottom', property: 'margin-bottom'},
                    { name: 'Left', property: 'margin-left'}
                  ],
                },{
                  property  : 'padding',
                  properties:[
                    { name: 'Top', property: 'padding-top'},
                    { name: 'Right', property: 'padding-right'},
                    { name: 'Bottom', property: 'padding-bottom'},
                    { name: 'Left', property: 'padding-left'}
                  ],
                }],
              },{
                name: 'Typography',
                open: false,
                buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-align', 'text-decoration', 'text-shadow'],
                properties:[
                  { name: 'Font', property: 'font-family'},
                  { name: 'Weight', property: 'font-weight'},
                  { name:  'Font color', property: 'color'},
                  {
                    property: 'text-align',
                    type: 'radio',
                    defaults: 'left',
                    list: [
                      { value : 'left',  name : 'Left',    className: 'fa fa-align-left'},
                      { value : 'center',  name : 'Center',  className: 'fa fa-align-center' },
                      { value : 'right',   name : 'Right',   className: 'fa fa-align-right'},
                      { value : 'justify', name : 'Justify',   className: 'fa fa-align-justify'}
                    ],
                  },{
                    property: 'text-decoration',
                    type: 'radio',
                    defaults: 'none',
                    list: [
                      { value: 'none', name: 'None', className: 'fa fa-times'},
                      { value: 'underline', name: 'underline', className: 'fa fa-underline' },
                      { value: 'line-through', name: 'Line-through', className: 'fa fa-strikethrough'}
                    ],
                  },{
                    property: 'text-shadow',
                    properties: [
                      { name: 'X position', property: 'text-shadow-h'},
                      { name: 'Y position', property: 'text-shadow-v'},
                      { name: 'Blur', property: 'text-shadow-blur'},
                      { name: 'Color', property: 'text-shadow-color'}
                    ],
                }],
              },{
                name: 'Decorations',
                open: false,
                buildProps: ['opacity', 'border-radius', 'border', 'box-shadow', 'background-bg'],
                properties: [{
                  type: 'slider',
                  property: 'opacity',
                  defaults: 1,
                  step: 0.01,
                  max: 1,
                  min:0,
                },{
                  property: 'border-radius',
                  properties  : [
                    { name: 'Top', property: 'border-top-left-radius'},
                    { name: 'Right', property: 'border-top-right-radius'},
                    { name: 'Bottom', property: 'border-bottom-left-radius'},
                    { name: 'Left', property: 'border-bottom-right-radius'}
                  ],
                },{
                  property: 'box-shadow',
                  properties: [
                    { name: 'X position', property: 'box-shadow-h'},
                    { name: 'Y position', property: 'box-shadow-v'},
                    { name: 'Blur', property: 'box-shadow-blur'},
                    { name: 'Spread', property: 'box-shadow-spread'},
                    { name: 'Color', property: 'box-shadow-color'},
                    { name: 'Shadow type', property: 'box-shadow-type'}
                  ],
                },{
                  id: 'background-bg',
                  property: 'background',
                  type: 'bg',
                },],
              },{
                name: 'Extra',
                open: false,
                buildProps: ['transition', 'perspective', 'transform'],
                properties: [{
                  property: 'transition',
                  properties:[
                    { name: 'Property', property: 'transition-property'},
                    { name: 'Duration', property: 'transition-duration'},
                    { name: 'Easing', property: 'transition-timing-function'}
                  ],
                },{
                  property: 'transform',
                  properties:[
                    { name: 'Rotate X', property: 'transform-rotate-x'},
                    { name: 'Rotate Y', property: 'transform-rotate-y'},
                    { name: 'Rotate Z', property: 'transform-rotate-z'},
                    { name: 'Scale X', property: 'transform-scale-x'},
                    { name: 'Scale Y', property: 'transform-scale-y'},
                    { name: 'Scale Z', property: 'transform-scale-z'}
                  ],
                }]
              },{
                name: 'Flex',
                open: false,
                properties: [{
                  name: 'Flex Container',
                  property: 'display',
                  type: 'select',
                  defaults: 'block',
                  list: [
                    { value: 'block', name: 'Disable'},
                    { value: 'flex', name: 'Enable'}
                  ],
                },{
                  name: 'Flex Parent',
                  property: 'label-parent-flex',
                  type: 'integer',
                },{
                  name      : 'Direction',
                  property  : 'flex-direction',
                  type    : 'radio',
                  defaults  : 'row',
                  list    : [{
                            value   : 'row',
                            name    : 'Row',
                            className : 'icons-flex icon-dir-row',
                            title   : 'Row',
                          },{
                            value   : 'row-reverse',
                            name    : 'Row reverse',
                            className : 'icons-flex icon-dir-row-rev',
                            title   : 'Row reverse',
                          },{
                            value   : 'column',
                            name    : 'Column',
                            title   : 'Column',
                            className : 'icons-flex icon-dir-col',
                          },{
                            value   : 'column-reverse',
                            name    : 'Column reverse',
                            title   : 'Column reverse',
                            className : 'icons-flex icon-dir-col-rev',
                          }],
                },{
                  name      : 'Justify',
                  property  : 'justify-content',
                  type    : 'radio',
                  defaults  : 'flex-start',
                  list    : [{
                            value   : 'flex-start',
                            className : 'icons-flex icon-just-start',
                            title   : 'Start',
                          },{
                            value   : 'flex-end',
                            title    : 'End',
                            className : 'icons-flex icon-just-end',
                          },{
                            value   : 'space-between',
                            title    : 'Space between',
                            className : 'icons-flex icon-just-sp-bet',
                          },{
                            value   : 'space-around',
                            title    : 'Space around',
                            className : 'icons-flex icon-just-sp-ar',
                          },{
                            value   : 'center',
                            title    : 'Center',
                            className : 'icons-flex icon-just-sp-cent',
                          }],
                },{
                  name      : 'Align',
                  property  : 'align-items',
                  type    : 'radio',
                  defaults  : 'center',
                  list    : [{
                            value   : 'flex-start',
                            title    : 'Start',
                            className : 'icons-flex icon-al-start',
                          },{
                            value   : 'flex-end',
                            title    : 'End',
                            className : 'icons-flex icon-al-end',
                          },{
                            value   : 'stretch',
                            title    : 'Stretch',
                            className : 'icons-flex icon-al-str',
                          },{
                            value   : 'center',
                            title    : 'Center',
                            className : 'icons-flex icon-al-center',
                          }],
                },{
                  name: 'Flex Children',
                  property: 'label-parent-flex',
                  type: 'integer',
                },{
                  name:     'Order',
                  property:   'order',
                  type:     'integer',
                  defaults :  0,
                  min: 0
                },{
                  name    : 'Flex',
                  property  : 'flex',
                  type    : 'composite',
                  properties  : [{
                          name:     'Grow',
                          property:   'flex-grow',
                          type:     'integer',
                          defaults :  0,
                          min: 0
                        },{
                          name:     'Shrink',
                          property:   'flex-shrink',
                          type:     'integer',
                          defaults :  0,
                          min: 0
                        },{
                          name:     'Basis',
                          property:   'flex-basis',
                          type:     'integer',
                          units:    ['px','%',''],
                          unit: '',
                          defaults :  'auto',
                        }],
                },{
                  name      : 'Align',
                  property  : 'align-self',
                  type      : 'radio',
                  defaults  : 'auto',
                  list    : [{
                            value   : 'auto',
                            name    : 'Auto',
                          },{
                            value   : 'flex-start',
                            title    : 'Start',
                            className : 'icons-flex icon-al-start',
                          },{
                            value   : 'flex-end',
                            title    : 'End',
                            className : 'icons-flex icon-al-end',
                          },{
                            value   : 'stretch',
                            title    : 'Stretch',
                            className : 'icons-flex icon-al-str',
                          },{
                            value   : 'center',
                            title    : 'Center',
                            className : 'icons-flex icon-al-center',
                          }],
                }]
              }
            ],
          },
        },
      });

      editor.I18n.addMessages({
        en: {
          styleManager: {
            properties: {
              'background-repeat': 'Repeat',
              'background-position': 'Position',
              'background-attachment': 'Attachment',
              'background-size': 'Size',
            }
          },
        }
      });

      var pn = editor.Panels;
      var modal = editor.Modal;
      var cmdm = editor.Commands;
      cmdm.add('canvas-clear', function() {
        if(confirm('Areeee you sure to clean the canvas?')) {
          var comps = editor.DomComponents.clear();
          setTimeout(function(){ localStorage.clear()}, 0)
        }
      });
      cmdm.add('set-device-desktop', {
        run: function(ed) { ed.setDevice('Desktop') },
        stop: function() {},
      });
      cmdm.add('set-device-tablet', {
        run: function(ed) { ed.setDevice('Tablet') },
        stop: function() {},
      });
      cmdm.add('set-device-mobile', {
        run: function(ed) { ed.setDevice('Mobile portrait') },
        stop: function() {},
      });



      // Add info command
      var mdlClass = 'gjs-mdl-dialog-sm';
      var infoContainer = document.getElementById('info-panel');
      cmdm.add('open-info', function() {
        var mdlDialog = document.querySelector('.gjs-mdl-dialog');
        mdlDialog.className += ' ' + mdlClass;
        infoContainer.style.display = 'block';
        modal.setTitle('About this demo');
        modal.setContent(infoContainer);
        modal.open();
        modal.getModel().once('change:open', function() {
          mdlDialog.className = mdlDialog.className.replace(mdlClass, '');
        })
      });
      pn.addButton('options', {
        id: 'open-info',
        className: 'fa fa-question-circle',
        command: function() { editor.runCommand('open-info') },
        attributes: {
          'title': 'About',
          'data-tooltip-pos': 'bottom',
        },
      });


      // Simple warn notifier
      var origWarn = console.warn;
      toastr.options = {
        closeButton: true,
        preventDuplicates: true,
        showDuration: 250,
        hideDuration: 150
      };
      console.warn = function (msg) {
        if (msg.indexOf('[undefined]') == -1) {
          toastr.warning(msg);
        }
        origWarn(msg);
      };


      // Add and beautify tooltips
      [['sw-visibility', 'Show Borders'], ['preview', 'Preview'], ['fullscreen', 'Fullscreen'],
       ['export-template', 'Export'], ['undo', 'Undo'], ['redo', 'Redo'],
       ['gjs-open-import-webpage', 'Import'], ['canvas-clear', 'Clear canvas']]
      .forEach(function(item) {
        pn.getButton('options', item[0]).set('attributes', {title: item[1], 'data-tooltip-pos': 'bottom'});
      });
      [['open-sm', 'Style Manager'], ['open-layers', 'Layers'], ['open-blocks', 'Blocks']]
      .forEach(function(item) {
        pn.getButton('views', item[0]).set('attributes', {title: item[1], 'data-tooltip-pos': 'bottom'});
      });
      var titles = document.querySelectorAll('*[title]');

      for (var i = 0; i < titles.length; i++) {
        var el = titles[i];
        var title = el.getAttribute('title');
        title = title ? title.trim(): '';
        if(!title)
          break;
        el.setAttribute('data-tooltip', title);
        el.setAttribute('title', '');
      }

      // Show borders by default
      pn.getButton('options', 'sw-visibility').set('active', 1);


      // Store and load events
      editor.on('storage:load', function(e) { console.log('Loaded ', e) });
      editor.on('storage:store', function(e) { console.log('Stored ', e) });


      // Do stuff on load
      editor.on('load', function() {
        var $ = grapesjs.$;

        // Show logo with the version
        var logoCont = document.querySelector('.gjs-logo-cont');
        document.querySelector('.gjs-logo-version').innerHTML = 'v' + grapesjs.version;
        var logoPanel = document.querySelector('.gjs-pn-commands');
        logoPanel.appendChild(logoCont);


        // Load and show settings and style manager
        var openTmBtn = pn.getButton('views', 'open-tm');
        openTmBtn && openTmBtn.set('active', 1);
        var openSm = pn.getButton('views', 'open-sm');
        openSm && openSm.set('active', 1);

        // Add Settings Sector
        var traitsSector = $('<div class="gjs-sm-sector no-select">'+
          '<div class="gjs-sm-title"><span class="icon-settings fa fa-cog"></span> Settings</div>' +
          '<div class="gjs-sm-properties" style="display: none;"></div></div>');
        var traitsProps = traitsSector.find('.gjs-sm-properties');
        traitsProps.append($('.gjs-trt-traits'));
        $('.gjs-sm-sectors').before(traitsSector);
        traitsSector.find('.gjs-sm-title').on('click', function(){
          var traitStyle = traitsProps.get(0).style;
          var hidden = traitStyle.display == 'none';
          if (hidden) {
            traitStyle.display = 'block';
          } else {
            traitStyle.display = 'none';
          }
        });

        // Open block manager
        var openBlocksBtn = editor.Panels.getButton('views', 'open-blocks');
        openBlocksBtn && openBlocksBtn.set('active', 1);

        // Move Ad
        $('#gjs').append($('.ad-cont'));
      });

      /**
    var editor = grapesjs.init({
        showOffsets: 1,
        noticeOnUnload: 0,
        container: '#gjs',
        height: '100%',
        fromElement: true,
        storageManager: {
            type: 'remote',
            stepsBeforeSave: 0,
            autosave: true, // Store data automatically
            autoload: true,
            urlStore: "{{ route('common_page_grapes_update') }}?id={{ $page->id ?? null }}",
            urlLoad: "{{ route('common_page_grapes_load_now') }}?id={{ $page->id ?? null }}",            
            contentTypeJson: true,
            storeComponents: true,
            storeStyles: true,
            storeHtml: true,
            storeCss: true,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        styleManager : {
            sectors: [{
                name: 'General',
                open: false,
                buildProps: ['float', 'display', 'position', 'top', 'right', 'left', 'bottom']
            }, {
                name: 'Flex',
                open: false,
                buildProps: ['flex-direction', 'flex-wrap', 'justify-content', 'align-items', 'align-content', 'order', 'flex-basis', 'flex-grow', 'flex-shrink', 'align-self']
            }, {
                name: 'Dimension',
                open: false,
                buildProps: ['width', 'height', 'max-width', 'min-height', 'margin', 'padding'],
            }, {
                name: 'Typography',
                open: false,
                buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-shadow'],
            }, {
                name: 'Decorations',
                open: false,
                buildProps: ['border-radius-c', 'background-color', 'border-radius', 'border', 'box-shadow', 'background'],
            }, {
                name: 'Extra',
                open: false,
                buildProps: ['transition', 'perspective', 'transform'],
            }
            ],
        },
    });

    editor.BlockManager.add('testBlock', {
        label: 'Block',
        attributes: { class:'gjs-fonts gjs-f-b1' },
        content: `<div style="padding-top:50px; padding-bottom:50px; text-align:center">Test block</div>`
    });
    **/
</script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $.noConflict();

        $('#title').blur(function () {
            var m = $(this).val();
            var cute1 = m.toLowerCase().replace(/ /g, '-').replace(/&amp;/g, 'and').replace(/&/g, 'and').replace(/ ./g, 'dec');
            var cute = cute1.replace(/[`~!@#$%^&*()_|+\=?;:'"”,.<>\{\}\[\]\\\/]/gi, '');

            $('#seo_url').val(cute);
        });

    });
    function get_id(identifier) {
        //alert("data-id:" + jQuery(identifier).data('id') + ", data-option:" + jQuery(identifier).data('option'));
        var dataid = jQuery(identifier).data('id');
        jQuery('#image_ids').val(
            function(i, val) {
                return val + (!val ? '' : ', ') + dataid;
            });
        var option = jQuery(identifier).data('option');
        jQuery('#show_image_names').html(
            function(i, val) {
                return val + (!val ? '' : ', ') + option;
            }
        );
    }
</script>
@endsection