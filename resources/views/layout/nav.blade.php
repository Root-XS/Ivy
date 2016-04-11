    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <nav>
            <ul class="nav navbar-nav navbar-right">

                @if (Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        My Account ({{ Auth::user()->firstname }}) <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <!--<li>{!! HTML::link('about', 'How It Works') !!}</li>-->
                        <li>{!! HTML::link('user', 'Edit Profile') !!}</li>
                        <li>{!! HTML::link('profile/password', 'Change Password') !!}</li>
                        <li class="divider"></li>
                        <li>{!! HTML::link('logout', 'Logout') !!}</li>
                    </ul>
                </li>
                @else
                <br>
                @include('auth.form.login')
                @endif

            </ul>
        </nav>
    </div>
