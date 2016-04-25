    <ul class="nav navbar-nav">
        <li{!! 'people' === $strController ? ' class="active"' : '' !!}>
            <a href="/people">
                People
                @if ('people' === $strController)
                <span class="sr-only">(current)</span>
                @endif
            </a>
        </li>
        <li{!! 'groups' === $strController ? ' class="active"' : '' !!}>
            <a href="/groups">
                Groups
                @if ('groups' === $strController)
                <span class="sr-only">(current)</span>
                @endif
            </a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Dropdown <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li class="active"><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
            </ul>
        </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                @glyphicon('cog') <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </li>
    </ul>
