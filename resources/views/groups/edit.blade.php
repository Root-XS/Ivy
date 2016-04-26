@extends('layout.master')

@section('content')
<div class="row">

    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Group Details</h3>
            </div>
            <div class="panel-body">
                @include('groups.form')
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Group Members</h3>
            </div>
            <ul class="list-group">
                @foreach ($oGroup->users as $oUser)
                <li class="list-group-item">
                    {{ $oUser }}
                </li>
                @endforeach
                @if (!$oGroup->users->count())
                <li class="list-group-item">
                    No members found.
                </li>
                @endif
            </ul>
        </div>
    </div>

</div>
@endsection
