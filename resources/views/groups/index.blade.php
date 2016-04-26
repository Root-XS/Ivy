@extends('layout.master')

@section('content')
<div class="row">

    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Group Categories</h3>
            </div>
            <div class="list-group">
                @foreach (Ivy\Model\Group::listTags() as $oTag)
                <a class="list-group-item" href="/groups/tag/{{ $oTag->id }}">
                    {{ $oTag->description }}
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-sm-9">

        {{-- Search --}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Search
                </h3>
            </div>
            <div class="panel-body">
                <form role="form" method="GET" action="{{ url('/groups/search') }}">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" value="{{ old('q')}}" placeholder="Find a group...">
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
                @include('groups.form')
            </div>
        </div>

    </div>
</div>
@endsection
