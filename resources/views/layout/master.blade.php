<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        Ivy CMS.
        @if ('production' !== App::environment())
        ({{ App::environment() }})
        @endif
    </title>
    <meta name="description" content="DESCRIPTION GOES HERE">

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    {!! HTML::style('/css/styles.css?v=0.0', [], Config::get('app.forceHttps')) !!}
    <style>
        body {
            font-family: 'Lato';
        }
    </style>

    <!--[if lt IE 9]>
    {!! HTML::script('//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') !!}
    {!! HTML::script('//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') !!}
    <![endif]-->
</head>

<body>
    @if ($bGuestHome ?? false)
    <img src="/img/jumbotron.jpg">
    @endif
    <div id="body">

        <header>
            @include('layout.nav')
        </header>

        @if ($__env->yieldContent('subnav'))
        @include('layout.subnav')
        @endif

        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissable">
            {{ session('success') }}
        </div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissable">
            {{ session('error') }}
        </div>
        @endif

        @if ($bGuestHome ?? false)
        @yield('content')
        @else
        <div class="container">
            @yield('content')
        </div>
        @endif

    </div>

    <footer>
        <div class="container">
            Copyright &copy; {{ date('Y') }} <b>Root XS</b>
            <br>
            {!! HTML::link('/privacy', trans('layout.link.privacy')) !!} |
            {!! HTML::link('/terms', trans('layout.link.terms')) !!}
        </div>
    </footer>

    {!! HTML::script('/js/require.js?v=0.0', ['data-main' => '/js/main', 'async' => ''], Config::get('app.forceHttps')) !!}

</body>
</html>