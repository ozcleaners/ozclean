<div class="section-background" style="background-color: #FFFFFF;padding-bottom: 50px;">
    <div class="row m-0 justify-content-center">
        <div class="xcontainer col-xl-8 col-lg-11">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="heading-4 text-center">Why choose us</h4>
                    </div>
                @php
                    $getWhyChoseUse = function($position = []) use($Post, $Query){
                      $get = $Post::category($Query::frontendSettings('home_why_choose_us'));
                      return $get->whereIn('position', $position)->get();
                    };

                    //dump($getWhyChoseUse->where('position', 'Middle')->get());
                @endphp
                <!----------- DESKTOP VERSION OF WHY CHOOSE US -------->
                    <div class="why-choose-us-for-desktop row d-none d-lg-block">
                        <div class="col-lg-4">
                        @foreach($getWhyChoseUse(['Left']) as $post)
                            <!----- SERVICE BOX ------>
                                <div class="animated-service-box">
                                    <div class="animated-service-icon">
                                        <i aria-hidden="true" class="{{$post->font_awesome_icon}}"></i>
                                    </div>
                                    <div class="animated-service-content">
                                        <h3 class="animated-service-title"> {{$post->title}} </h3>
                                        <div class="animated-service-description">{{$post->short_description}}</div>
                                        <span class="animated-service-link" href="javacsript:void()">
                                            <i class="fa fa-long-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                        @endforeach
                        <!----- END SERVICE ------>
                        </div>
                        <div class="col-lg-4 desktop-top-padding">
                            <!----- SINGLE BANNER ------>
                            <div class="row-spacer-short"></div>
                            @foreach($getWhyChoseUse(['Middle Top']) as $post)
                                <div class="single-banner">
                                    <div class="single-banner-inner">
                                        <!----- BANNER IMAGE ------>
                                        <img src="{{$Media::fullSize($post->images)}}" class="img-responsive" alt="">
                                        <!----- BANNER CONTENT ------>
                                        <div class="single-banner-content">
                                            <div class="single-banner-content-meta">
                                                <div class="single-banner-content-heading">{{$post->title}} </div>
                                                <h4 class="single-banner-content-info">{{$post->short_description}}</h4>
                                            </div>
                                            <svg class="single-banner-content-bg" xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 123 112">
                                                <path
                                                    d="M22.46,0.262a673.892,673.892,0,0,1,80.844,6.4c10.079,0.592,18.735,9.565,19.027,19.5,0.3,10.95.4,40.706,0.279,51.6-0.133,9.926-8.631,18.351-18.682,18.816-27.125,3.568-54.074,7.216-81.04,8.5-10.037-.5-18.485-9.1-18.424-18.875,0.077-15.525.671-50.13,0.527-66.126C4.9,9.975,12.466.983,22.46,0.262h0Z"></path>
                                            </svg>
                                            <svg class="single-banner-content-overlay-bg"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 123 112">
                                                <path
                                                    d="M22.46,0.262a673.892,673.892,0,0,1,80.844,6.4c10.079,0.592,18.735,9.565,19.027,19.5,0.3,10.95.4,40.706,0.279,51.6-0.133,9.926-8.631,18.351-18.682,18.816-27.125,3.568-54.074,7.216-81.04,8.5-10.037-.5-18.485-9.1-18.424-18.875,0.077-15.525.671-50.13,0.527-66.126C4.9,9.975,12.466.983,22.46,0.262h0Z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                        <!----- END SINGLE BANNER ------>
                            <div class="row mobile-bottom-spacer">
                                @foreach($getWhyChoseUse(['Middle Bottom']) as $post)
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <div class="small-counter-with-icon-wrap">
                                            <div class="small-counter-with-icon-inner">
                                                <div class="small-counter-with-icon-item-icon">
                                                    <i aria-hidden="true" class="{{$post->font_awesome_icon}}"></i>
                                                </div>
                                                <div class="small-counter-with-icon-holder">
                                                    <div class="small-counter-number">
                                                        <span
                                                            class="small-counter-number-value single-counter-number-value">{{$post->title}}</span>
                                                        <span class="small-counter-number-suffix">+</span>
                                                    </div>
                                                    <div class="small-counter-title">{{$post->short_description}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <div class="col-lg-4">
                            <!----- SERVICE BOX ------>
                            @foreach($getWhyChoseUse(['Right']) as $post)
                                <div class="animated-service-box">
                                    <div class="animated-service-icon">
                                        <i aria-hidden="true" class="{{$post->font_awesome_icon}}"></i>
                                    </div>
                                    <div class="animated-service-content">
                                        <h3 class="animated-service-title"> {{$post->title}}</h3>
                                        <div class="animated-service-description">{{$post->short_description}}</div>
                                        <span class="animated-service-link" href="#">
                                            <i class="fa fa-long-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <!----------- MOBILE VERSION OF WHY CHOOSE US -------->
                    <div class="why-choose-us-for-mobile d-block d-lg-none">
                        <div class="col-md-12 desktop-top-padding">
                            <!----- SINGLE BANNER ------>
                            <div class="row-spacer-short"></div>
                            @foreach($getWhyChoseUse(['Middle Top']) as $post)
                                <div class="single-banner">
                                    <div class="single-banner-inner">
                                        <!----- BANNER IMAGE ------>
                                        <img src="{{$Media::fullSize($post->images)}}" class="img-responsive"
                                             alt="{{ $post->title  ?? NULL }}">
                                        <!----- BANNER CONTENT ------>
                                        <div class="single-banner-content">
                                            <div class="single-banner-content-meta">
                                                <div class="single-banner-content-heading">{{ $post->title  ?? NULL }}</div>
                                                <h4 class="single-banner-content-info">{{$post->short_description}}</h4>
                                            </div>
                                            <svg class="single-banner-content-bg" xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 123 112">
                                                <path
                                                    d="M22.46,0.262a673.892,673.892,0,0,1,80.844,6.4c10.079,0.592,18.735,9.565,19.027,19.5,0.3,10.95.4,40.706,0.279,51.6-0.133,9.926-8.631,18.351-18.682,18.816-27.125,3.568-54.074,7.216-81.04,8.5-10.037-.5-18.485-9.1-18.424-18.875,0.077-15.525.671-50.13,0.527-66.126C4.9,9.975,12.466.983,22.46,0.262h0Z"></path>
                                            </svg>
                                            <svg class="single-banner-content-overlay-bg"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 123 112">
                                                <path
                                                    d="M22.46,0.262a673.892,673.892,0,0,1,80.844,6.4c10.079,0.592,18.735,9.565,19.027,19.5,0.3,10.95.4,40.706,0.279,51.6-0.133,9.926-8.631,18.351-18.682,18.816-27.125,3.568-54.074,7.216-81.04,8.5-10.037-.5-18.485-9.1-18.424-18.875,0.077-15.525.671-50.13,0.527-66.126C4.9,9.975,12.466.983,22.46,0.262h0Z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="row-spacer"></div>
                            <div class="row mobile-bottom-spacer">
                                @foreach($getWhyChoseUse(['Middle Bottom']) as $post)
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <div class="small-counter-with-icon-wrap">
                                            <div class="small-counter-with-icon-inner">
                                                <div class="small-counter-with-icon-item-icon">
                                                    <i aria-hidden="true" class="{{$post->font_awesome_icon}}"></i>
                                                </div>
                                                <div class="small-counter-with-icon-holder">
                                                    <div class="small-counter-number">
                                                        <span
                                                            class="small-counter-number-value single-counter-number-value">{{$post->title  ?? NULL }}</span>
                                                        <span class="small-counter-number-suffix">+</span>
                                                    </div>
                                                    <div class="small-counter-title">{{$post->short_description}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!----- SERVICE BOX ------>
                        <div class="xanimated-service-mobile-carousel xowl-carousel">
                            @foreach($getWhyChoseUse(['Right', 'Left']) as $post)
                              <div class="animated-service-box mobile-animate-content-box mb-3">
                                  <div class="animated-service-icon">
                                      <i aria-hidden="true" class="{{$post->font_awesome_icon}}"></i>
                                  </div>
                                  <div class="animated-service-content">
                                      <h3 class="animated-service-title">{{$post->title  ?? NULL }}</h3>
                                      <div class="animated-service-description">{{$post->short_description}}</div>
                                      <span class="animated-service-link" href="#">
                                            <i class="fa fa-long-arrow-right"></i>
                                        </span>
                                  </div>
                              </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

