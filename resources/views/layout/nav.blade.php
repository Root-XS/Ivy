    <nav class="navbar navbar-default">
        <div class="container">

            {{-- Brand and toggle (for mobile) --}}
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#ivy-nav" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                    Ivy
                    {{-- <img src="..."> --}}
                </a>
            </div>

            {{-- Nav elements for toggling --}}
            <div class="collapse navbar-collapse" id="ivy-nav">
                @include('layout.nav.' . (Auth::guest() ? 'guest' : 'member'))
            </div>

        </div>
    </nav>
