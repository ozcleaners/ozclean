<div class="container-fluid">
    <div class="annimated-counter-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 row mx-auto">
                    <!----- ANIMATED COUNTER BOX ------>
                    <div class="col-md-3 col-6">
                        <div class="animated-counter">
                            <div class="animated-counter-inner">
                                @php
                                    $data = get_frontend_setting('team_members');
                                @endphp
                                <div class="ianimated-counter-icon">
                                    <i class="{{ $data['meta_value'][2] }}"></i>
                                </div>
                                <div class="animated-counter-content">
                                    <div class="animated-counter-number">
                                        <span class="animated-counter-number-value">{{ $data['meta_value'][1] }}</span>
                                        <span class="animated-counter-number-suffix">+</span>
                                    </div>
                                    <div class="animated-counter-title">{{ $data['meta_value'][0]  }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!----- ANIMATED COUNTER BOX ------>
                    <div class="col-md-3 col-6">
                        <div class="animated-counter">
                            <div class="animated-counter-inner">
                                @php
                                    $data = get_frontend_setting('ratings_as');
                                @endphp
                                <div class="ianimated-counter-icon">
                                    <i class="{{ $data['meta_value'][2] }}"></i>
                                </div>
                                <div class="animated-counter-content">
                                    <div class="animated-counter-number">
                                        <span class="animated-counter-number-value">{{ $data['meta_value'][1] }}</span>
                                        <span class="animated-counter-number-suffix">+</span>
                                    </div>
                                    <div class="animated-counter-title">{{ $data['meta_value'][0]  }} 5*</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!----- ANIMATED COUNTER BOX ------>
                    <div class="col-md-3 col-6">
                        <div class="animated-counter">
                            <div class="animated-counter-inner">
                                @php
                                    $data = get_frontend_setting('happy_clients');
                                @endphp
                                <div class="ianimated-counter-icon">
                                    <i class="{{ $data['meta_value'][2] }}"></i>
                                </div>
                                <div class="animated-counter-content">
                                    <div class="animated-counter-number">
                                        <span class="animated-counter-number-value">{{ $data['meta_value'][1] }}</span>
                                        <span class="animated-counter-number-suffix">+</span>
                                    </div>
                                    <div class="animated-counter-title">{{ $data['meta_value'][0]  }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!----- ANIMATED COUNTER BOX ------>
                    <div class="col-md-3 col-6">
                        <div class="animated-counter">
                            <div class="animated-counter-inner">
                                @php
                                    $data = get_frontend_setting('jobs_done');
                                @endphp
                                <div class="ianimated-counter-icon">
                                    <i class="{{ $data['meta_value'][2] }}"></i>
                                </div>
                                <div class="animated-counter-content">
                                    <div class="animated-counter-number">
                                        <span class="animated-counter-number-value">{{ $data['meta_value'][1] }}</span>
                                        <span class="animated-counter-number-suffix">+</span>
                                    </div>
                                    <div class="animated-counter-title">{{ $data['meta_value'][0]  }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!----- END ANIMATED COUNTER REPEAT ------>
                </div>
            </div>
        </div>
    </div>
</div>
