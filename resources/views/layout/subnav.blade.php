    <nav class="subnav">
        <div class="container">
            <ul class="nav nav-tabs nav-justified">
                @foreach ($aModules as $strKey => $strMod)
                <li role="presentation"{!! $strMod === $strModule ? ' class="active"' : '' !!}>
                    <a href="@yield('subnav'){{ $strMod }}">
                        {!! is_numeric($strKey) ? ucfirst($strMod) : $strKey !!}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </nav>
    <div class="subnav-buffer"></div>
