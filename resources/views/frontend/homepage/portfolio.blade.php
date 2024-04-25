@php
    $subAlbumId = null;
    $query = $Query::accessModel('Album')::where('albums_pcat_id', $Query::frontendSettings('home_portfolio_cat_id'))
             ->where('is_active', '1')->orderBy('id', 'ASC')->get();
    //dd($query);
    $pageName = '';
@endphp
<div class="section-background portfolio-section" style="background: #fff;padding: 50px 0px;">
    <div class="row m-0 justify-content-center">
        <div class="xcontainer col-lg-10">
            <div class="row">
                <div class="col-md-12 text-lg-center text-left">
                    <!----------- HEADING TEXT WITH ICON ------->
                    <div class="heading-with-icon">
                        <div class="heading-with-icon-wrap d-none">
                            <div class="heading-with-icon-inner">
                                <div class="heading-icon"></div>
                                Our Portfolio
                            </div>
                        </div>
                        <h3 class="heading-with-icon-text">
                            <span> Some work from our <small>memorable gallery.</small> </span>
                        </h3>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 text-lg-center text-left">
                    <!----------- BASIC TEXT BLOCK ------->
                    <div class="basic-text-block mt-0 mb-5">
{{--                        <br class="temporary-top-spacer"/>--}}
                        We shows only the best websites and portfolios built completely with passion, simplicity
                        &amp; creativity.
                    </div>
                    <!----------- END BASIC TEXT BLOCK ------->
                </div>
            </div>
            <!-------------- PORTFOLIO START ---------->
            <div class="portfolio-wrap">
                <!-------------- PORTFOLIO BUTTON ---------->
                <div class="portfolio-filter-wrap button-group text-center mb-0">
                    <span class="filter-item is-checked" data-filter="*">All</span>
                    @foreach($query as $key => $value)
                        <span class="filter-item" data-filter=".cleaning{{ $value->id }}">
                            {{ $value->name ?? NULL }}
                        </span>
                    @endforeach
                </div>

                <?php /*<div class="portfolio-grid">
                    @foreach($query as $key => $value)
                        @php
                            $pictures = $Query::accessModel('Gallery')::where('category_id', $value->id)->get();
                        @endphp
                        @foreach($pictures as $k => $v)
                            <div class="portfolio-item portfolio-item-loader cleaning{{ $value->id }}">
                                <div class="portfolio-item-inner">
                                    <div class="portfolio-item-img">
                                        <img class="img-responsive"
                                             src="{{ $Media::fullSize($v->media_id) }}"
                                             alt="{{ $value->name }}">
                                    </div>
                                    <div class="portfolio-content">
                                        <div class="item-readmore-link">
                                            <a href="#">+</a>
                                        </div>
                                        <div class="item-title">
                                            <h3 class="item-title-text"><a href="#">{{ $value->name }}</a></h3>
                                            <div class="item--divider"><span></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
                */ ?>

            </div>
            <!-------------- END PORTFOLIO ---------->
        </div>
    </div>


    <div class="row portfolio-style-2 text-white m-0">
        @foreach($query as $key => $value)
            @php
                $pictures = $Query::accessModel('Gallery')::where('category_id', $value->id)->get();
            @endphp
            @foreach($pictures as $k => $v)
                <div class="cleaning{{ $value->id }} my-3 mx-3">
                    <div class="entry-wrapper ">
                        <div class="entry-thumbnail-wrapper">
                            <div class="post-thumbnail">
                                <img src="{{ $Media::fullSize($v->media_id) }}" alt="">
                            </div>
                        </div>
                        <div class="entry-content-wrapper">
                            <div class="entry-header">
                                <h6 class="entry-title mb-5">
                                    <a class="text-white" href="">{{ $value->name }}</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>


