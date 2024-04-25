<div class="col-lg-2">
    <div class="card profile-menu">
        <div class="card-header">
            {{auth()->user()->name}}

            <a class="float-right" href="{{ route('logout') }}" title="Logout"
               onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  style="display: none;">
                @csrf
            </form>
        </div>
        <div class="card-body">
            <ul class="list">
                <li>
                    <a href="{{route('frontend_user_dashboard')}}">Orders</a>
                </li>
                <li>
                    <a href="">Track Order</a>
                </li>
                <li>
                    <a href="{{ route('frontend_edit_profile', auth()->user()->id) }}">Edit Profile</a>
                </li>
            </ul>
        </div>
    </div>
</div>
