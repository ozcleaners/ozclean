<header class="header">
    <button class="header__button" id="btnNav" type="button">
        <i class="material-icons">menu</i>
    </button>
    <a class="mobile-logo" href="{{ get_global_setting('website') }}">
        <img src="{{ get_global_setting('logo') }}" alt="{{ get_global_setting() }}"/>
    </a>
</header>
<nav class="nav" id="nav">
    <div class="nav__links">
        @php
            $primaryMenu = Menu::getByName('Primary Menu');
        @endphp
        @foreach($primaryMenu as $key => $value)
            <a class="nav__link {{ '/'.request()->path() == $value['link'] ? 'nav__link--active' : null }}"
               href="{{ url($value['link']) }}">
                <i class="material-icons">dashboard</i>

                {{ $value['label'] }}
            </a>
            @if(!empty($value['additional_file']))
                @include('frontend.templates.menu.' . $value['additional_file'])
            @endif
        @endforeach

        {{--        --}}
        {{--        <a href="#" class="nav__link {{ $active ?? NULL }}">--}}
        {{--            <i class="material-icons">dashboard</i>--}}
        {{--            Dashboard--}}
        {{--        </a>--}}
        {{--        <a class="nav__link nav__link--active" href="#">--}}
        {{--            <i class="material-icons">source</i>--}}
        {{--            Projects--}}

        {{--        </a>--}}

        {{--        <a class="nav__link" href="#">--}}
        {{--            <i class="material-icons">lock</i>--}}
        {{--            Security--}}
        {{--        </a>--}}
        {{--        <a class="nav__link" href="#">--}}
        {{--            <i class="material-icons">history</i>--}}
        {{--            History--}}
        {{--        </a>--}}
        {{--        <a class="nav__link" href="#">--}}
        {{--            <i class="material-icons">person</i>--}}
        {{--            Profile--}}
        {{--        </a>--}}
    </div>
    <div class="nav__overlay"></div>
</nav>
