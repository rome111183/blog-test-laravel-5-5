@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    @if(Session::has('flash_message'))
                        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div>
                    @endif
                    @if ($errors->has('id'))
                        <div class="alert alert-danger">
                            <strong>{{ $errors->first('id') }}</strong>
                        </div>
                    @endif
                    <a href="{{ url('/post/create') }}" class="btn btn-info right" role="button">Add New</a>
                    <hr>
                    @foreach($posts as $post)
                        <h3>ID: {{ $post->id }}</h3>
                        <p>Title: {{ $post->title}}</p>
                        <p>Slug: {{ $post->slug}}</p>
                        <p>
                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">Edit Post</a>
                        </p>
                        <p>
                            {!! Form::open([
                                'method' => 'destroy',
                                'route' => ['post.delete'],
                                'onsubmit' => "return confirm('Are you sure you want to delete this post?');"
                            ]) !!}
                                {{ Form::hidden('id', $post->id) }}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </p>
                        <hr>
                    @endforeach
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
