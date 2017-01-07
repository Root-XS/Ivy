@extends('layout.master')

@section('content')
<div class="row">
    <div class="col-md-12">

        {{-- Search --}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Search
                </h3>
            </div>
            <div class="panel-body">
                <form role="form" method="GET" action="{{ url('/people/search') }}">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" value="{{ old('q')}}" placeholder="Find someone...">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">@glyphicon('search')</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>

        {{-- Create --}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Create
                </h3>
            </div>
            <div class="panel-body">
                @include('auth.form.register', ['bRequirePassword' => false])
            </div>
        </div>

    </div>
</div>
@endsection
