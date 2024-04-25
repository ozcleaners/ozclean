<div class="row m-0 justify-content-center">
    <div class="xcontainer col-xl-10 col-lg-12">
        <div class="row text-lg-center text-left">
            <div class="col-md-12">
                <div class="heading-with-subtitle">
                    <h1 class="heading-text">
                        <span> {{ $Term::getContent($Query::FrontendSettings('home_blogs'))->name }} </span>
                    </h1>
                </div>
                <div class="basic-text-block">
                    {{ $Term::getContent($Query::FrontendSettings('home_blogs'))->term_subtitle }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="postbox owl-carousel">
                    @php
                        $blogs = function($position = [], $take, $offset) use($Post, $Query) {
                             $get = $Post::category($Query::frontendSettings('home_blogs'));
                             //return $get->whereIn('position', $position)->orderBy('id', 'desc')->get();
                             return $get->orderBy('id', 'desc')->take($take)->offset($offset)->get();
                           };
                    @endphp
                    @foreach ($blogs(['Left'], '2', '0') as $post)
                        <div class="postbox-wrap">
                            <div class="postbox-thumbnail">
                                <a href="{{route('frontend_blog', $post->seo_url)}}">
                                    <img class="img-responsive" src="{{$Media::fullSize($post->images)}}"
                                         alt="{!! $post->title !!}">
                                </a>
                            </div>
                            <div class="postbox-content">
                                <div class="postbox-content-inner">
                                    <ul class="postbox-content-meta" style="">
                                        <li class="postbox-content-date">
                                            <i class="fa fa-calendar"></i>{{$post->created_at->format('M d, Y')}}
                                        </li>
                                    </ul>
                                    <h3 class="postbox-content-heading">
                                        <a href="{{route('frontend_blog', $post->seo_url)}}">{!! $post->title !!}</a>
                                    </h3>
                                    <div class="postbox-content-readmore">
                                        <a href="{{route('frontend_blog', $post->seo_url)}}">
                                            Read more
                                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                @foreach ($blogs(['Right'] , '3', '2') as $post)
                    <div class="latest-vertical-blog unique-style">
                        <div class="vertical-blog-inner">
                            <div class="vertical-blog-thumb">
                                <a href="{{route('frontend_blog', $post->seo_url)}}">
                                    <img class="img-responsive" src="{{$Media::fullSize($post->images)}}"
                                         alt="{!! $post->title !!}">
                                </a>
                            </div>
                            <div class="vertical-blog-content">
                                <h6 class="vertical-blog-title">
                                    <a href="{{route('frontend_blog', $post->seo_url)}}">{!! $post->title !!}</a>
                                </h6>
                                <ul class="vertical-blog-meta">
                                    <li class="vertical-blog-meta-date">
                                        <i class="fa fa-calendar"></i> {{$post->created_at->format('M d, Y')}}
                                    </li>
                                    {{-- <li class="vertical-blog-meta-comment">
                                       <i class="fa fa-comment"></i> 2 Comments
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
