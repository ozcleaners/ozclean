@if(!empty($content->content_type) && $content->content_type == 'Bullets Horizontal')

    <div class="section_gap  row m-0 justify-content-center">
        <div class="xcontainer col-lg-10">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-center">
                        {!! $content->content_title !!}
                    </h4>
                    <div class="row service_list_group box-shadow">
                        @php
                            $breakdown_contents = $Query::accessModel('TermCustomFieldBreakdown')::where('term_custom_field_id', $content->id)->get();
                        @endphp
                        @foreach($breakdown_contents as $k => $v)
                            <div class="col-md-6">
                                <li class="list-group-item <?php echo ($k == 4) ? 'featured' : null ?> box-shadow">
                                    <div class="list-group-item-addon icon">
                                        <span><i class="fa fa-check"></i></span>
                                    </div>
                                    <div class="list-group-item-content">
                                        {!! $v->content_details !!}
                                    </div>
                                </li>
                            </div>
                        @endforeach
                        <div class="col-md-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
