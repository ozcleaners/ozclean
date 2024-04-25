@if(!empty($content->content_type) && $content->content_type == 'Tabs')
    <div class="section_gap  row m-0 justify-content-center">
        <div class="xcontainer col-lg-10">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-center">
                        {!! $content->content_title !!}
                    </h4>
                    <p style="margin: 0; padding: 0;">
                        {!! $content->content_sub_title ?? NULL !!}
                    </p>
                </div>
            </div>
            <!-- Tasb Section -->
            <div class="row p0">
                <div class="col-md-12">
                    <!-- Nav tabs -->
                    <div class="panel with-nav-tabs panel-success">
                        <div class="panel-heading py-0">
                            <ul class="nav nav-tabs" role="tablist">
                                @php
                                    $breakdown_contents = $Query::accessModel('TermCustomFieldBreakdown')::where('term_custom_field_id', $content->id)->get();
                                @endphp
                                @foreach($breakdown_contents as $k => $v)
                                    <li role="presentation" class="{{ $k == 0 ? 'active' : null }}"
                                        style="margin-bottom: -2px; margin-top: 5px;">
                                        <a href="#tab{{ $k }}" aria-controls="{{ $k }}" role="tab"
                                           class="text-success"
                                           data-toggle="tab"><span>{{ $v->content_title ?? NULL }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="panel-body">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                @foreach($breakdown_contents as $k => $v)
                                    <div role="tabpanel" class="tab-pane {{ $k == 0 ? 'active' : null }}"
                                         id="tab{{ $k }}">
                                        {!! $v->content_details !!}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
