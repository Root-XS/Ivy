    <form class="navbar-form navbar-right" role="form" method="POST" action="{{ url('/login') }}">
        <div class="form-group">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <input type="hidden" name="remember" value="1">
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
