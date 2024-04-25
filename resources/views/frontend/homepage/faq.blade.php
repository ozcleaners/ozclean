<div class="container-fluid">
    <div class="faq-wrap"
         style="background-image: url({{$Media::fullSize($Query::frontendSettings('home_faq_left_img'))}});">
        <div class="container">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="heading-with-icon">
                        <div class="heading-with-icon-wrap">
                            <div class="heading-with-icon-inner">
                                <div class="heading-icon"></div>
                                @php
                                    echo $Term::where('id', $Query::frontendSettings('home_faq_cat_id'))->first()->name;
                                @endphp
                            </div>
                        </div>
                        <h3 class="heading-with-icon-text">
                            <span>{{ $Query::accessModel('Term')::where('id', $Query::frontendSettings('home_faq_cat_id'))->first()->term_subtitle }}</span>
                        </h3>
                    </div>
                    <!----------------- FAQ START [ACCORDION]--------------->
                    <div class="animated-accordion panel-group" id="accordion" role="tablist"
                         aria-multiselectable="true">
                        @php
                            $faqs = $Post::category($Query::frontendSettings('home_faq_cat_id'))->get();
                        @endphp
                        @foreach($faqs as $k => $v)
                            <div class="accordion-item-repeater panel">
                                <div class="accordion-item-repeater-title">
                                    <a class="accordion-item-repeater-title-text" data-toggle="collapse"
                                       data-parent="#accordion" href="#accordionitem{{ $k }}" aria-expanded="true"
                                       aria-controls="accordionitem1">
                                        {{ $v->title ?? NULL }}
                                    </a>
                                </div>
                                <div id="accordionitem{{ $k }}"
                                     class="panel-collapse collapse accordion-item-repeater-content">
                                    {!! $v->description ?? NULL  !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!----------------- END ACCORDION --------------->
                </div>
            </div>
        </div>
    </div>
</div>
