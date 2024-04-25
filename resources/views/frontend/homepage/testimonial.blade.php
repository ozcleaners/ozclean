<div class="row m-0 justify-content-center">
    <div class="xcontainer col-lg-10">
        <div class="testimonial-wrap">
        <!----- TESTIMONIAL OVERLAY------>
        <div class="testimonial-background-overlay"></div>
        <!----- TESTIMONIAL HEADING ------>
        <div class="row text-center">
            <div class="col-md-12">
                @php
                    $getTestimonialId = $Query::frontendSettings('home_testimonial');

                @endphp
                <div class="heading-with-subtitle">
                    <div class="heading-subtext">
                        ...... {{ $Term::getColumn($getTestimonialId, 'name') }} ......
                    </div>
                    <h1 class="heading-text"><span>  {{ $Term::getColumn($getTestimonialId, 'term_subtitle') }}  </span>
                    </h1>
                </div>
                <div class="basic-text-block">
                    {!! $Term::getColumn($getTestimonialId, 'term_short_description') !!}
                </div>
            </div>
        </div>
        <!----- TESTIMONIAL ITEM START ------>
        <div class="testimonial-item-wrap owl-carousel">
            <!----- TESTIMONIAL ITEM ------>
            @php $testomonials = $Post::category($Query::frontendSettings('home_testimonial'))->get() @endphp
            @foreach ($testomonials as $post)
                <div class="testimonial-item text-justify">
                    <div class="testimonial-item-img">
                        <img class="img-responsive" src="{{$Media::iconSize($post->images)}}"
                             alt="{{ $post->title ?? NULL }}">
                    </div>
                    <div class="testimonial-item-description">
                        {{$post->short_description}}
                    </div>
                    <h3 class="testimonial-item-title">{{ $post->title ?? NULL }}</h3>
                    <div class="testimonial-item-position"></div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
</div>
<div class="row-spacer-short"></div>
