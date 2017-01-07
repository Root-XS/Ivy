@extends('layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('auth.form.register')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
