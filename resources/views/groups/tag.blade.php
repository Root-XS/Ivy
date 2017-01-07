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
                <a class="list-group-item{{ $oDisplayedTag->id == $oTag->id ? ' active' : '' }}" href="/groups/tag/{{ $oTag->id }}">
                    {{ $oTag->description }}
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-sm-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ $oDisplayedTag->description }}</h3>
            </div>
            <div class="list-group">
                @foreach ($oDisplayedTag->groups->get() as $oGroup)
                <a class="list-group-item" href="/groups/edit/{{ $oGroup->id }}">
                    {{ $oGroup->name }}
                </a>
                @endforeach
                @if (!$oDisplayedTag->groups->count())
                <div class="list-group-item">No groups found.</div>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection
