@extends('layout.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Edit User</h3>
            </div>
            <div class="panel-body">
                <form role="form" method="POST" action="{{ url('/people/edit/' . $oUser->id) }}">
                    {!! csrf_field() !!}

                    <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                        <input type="text" class="form-control" name="firstname" value="{{ $oUser->firstname }}" placeholder="First Name">

                        @if ($errors->has('firstname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('firstname') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                        <input type="text" class="form-control" name="lastname" value="{{ $oUser->lastname }}" placeholder="Last Name">

                        @if ($errors->has('lastname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" class="form-control" name="email" value="{{ $oUser->email }}" placeholder="Email">

                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
