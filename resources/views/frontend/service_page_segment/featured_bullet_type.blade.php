@if(!empty($content->content_type) && $content->content_type == 'Bullets Vertical')
    <div class="section_gap  row m-0 justify-content-center">
        <div class="xcontainer col-lg-10">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="service_section_title text-center">
                        {!! $content->content_title !!}
                    </h4>
                    <div class="row service_list_group vertical-align ">
                        <div class="col-md-8">
                            @php
                                $breakdown_contents = $Query::accessModel('TermCustomFieldBreakdown')::where('term_custom_field_id', $content->id)->get();
                            @endphp
                            @foreach($breakdown_contents as $k => $v)
                                <li class="list-group-item <?php echo ($k == 1) ? 'featured' : null ?>"
                                    style="padding: 0px 10px;">
                                    <div class="list-group-item-addon">
                                        <span>
                                            <?php
                                                echo str_pad(++$k, 2, '0', STR_PAD_LEFT);
                                            ?>
                                        </span>
                                    </div>
                                    <div class="list-group-item-content">
                                        {!! $v->content_details !!}
                                    </div>
                                </li>
                            @endforeach
                        </div>
                        <div class="col-md-4">
                            <img
                                src="{{ $Media::fullSize($content->content_image) }}"
                                alt="{{ $content->content_title ?? NULL }}"
                                class="img-responsive">
                        </div>
                    </div>
                    <div class="text-center font-weight-bold">
                        {!! $content->content_short_details ?? NULL !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
