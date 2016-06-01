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
                        <input type="text" name="q" class="form-control" value="{{ request('q')}}" placeholder="Find someone...">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">@glyphicon('search')</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>

        {{-- Results --}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Results</h3>
            </div>
            <div class="list-group">
                @foreach ($cResults as $oUser)
                <a class="list-group-item" href="/people/edit/{{ $oUser->id }}">
                    {{ $oUser->name }}
                </a>
                @endforeach
                @if (!$cResults->count())
                <div class="list-group-item">No people found.</div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
