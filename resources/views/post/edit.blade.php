@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Post</div>
                <div class="panel-body">
                    {!! Form::model($post, [
                        'method' => 'PATCH',
                        'enctype' => 'multipart/form-data',
                        'route' => ['post.edit', $post->id]
                    ]) !!}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-12 control-label">Title</label>

                            <div class="col-md-12">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $post->title }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                            <label for="slug" class="col-md-12 control-label">Slug</label>

                            <div class="col-md-12">
                                <input id="slug" type="text" class="form-control" name="slug" value="{{ $post->slug }}">

                                @if ($errors->has('slug'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('contents') ? ' has-error' : '' }}">
                            <label for="contents" class="col-md-4 control-label">Contents</label>
                            <div class="col-md-12 col-md-offset-0">
                              <table class="col-md-12 col-md-offset-0">
                              <tr>
                                <td style="width: 50%;">
                                  <div class="">
                                      <textarea class="form-control" rows="25" id="contents" name="contents">{{ $post->contents }}</textarea>
                                      @if ($errors->has('contents'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('contents') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                                </td>
                                <td style="width: 50%;vertical-align: top;">
                                  <div class="" id="rcontents">
                                      {!! $post->contents !!}
                                  </div>
                                </td>
                              </tr>
                              </table>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="Status" class="col-md-12 control-label">Status</label>

                            <div class="col-md-12">
                                {{
                                Form::select(
                                    'status',
                                    ['unpublish' => 'Unpublish', 'publish' => 'Publish'],
                                    $post->status,
                                    array(
                                        'class' => 'form-control',
                                        'id' => 'status'
                                    ))
                                }}

                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{ Form::hidden('updated_user_id', Auth::user()->id, [ 'id' => 'updated_user_id' ]) }}
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Update
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
//CKEDITOR.replace( 'contents' );
$('#contents').keyup(function() {
    $("#rcontents").html($(this).val());
});
</script>
@endsection
