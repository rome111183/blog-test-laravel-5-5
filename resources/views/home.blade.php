@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Post Listings</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(Session::has('flash_message'))
                        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div>
                    @endif
                    @if ($errors->has('id'))
                        <div class="alert alert-danger">
                            <strong>{{ $errors->first('id') }}</strong>
                        </div>
                    @endif

                    @foreach($posts as $post)
                        <h3>ID: {{ $post->id }}</h3>
                        <p>Title: {{ $post->title }}</p>
                        <p>Slug: {{ $post->slug }}</p>
                        <p>Author: {{ $post->name }}</p>
                        <hr>
                    @endforeach
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
