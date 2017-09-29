@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <div class="panel-default">
                          <div class="panel-body">
                              <a href="{{ url('/login/google') }}" class="btn btn-block btn-social btn-google">
                                  <span class="fa fa-google"></span> Sign in with Google
                              </a>
                          </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
