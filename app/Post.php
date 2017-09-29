<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'contents', 'owner_id', 'updated_user_id', 'status',
    ];

    /**
     *
     *
     *
     */
    public static function getPosts($loggedID = null, $pagination = 5){

        if(!$loggedID)
          return Post::join('users', 'users.id', '=', 'posts.owner_id')
              ->select('users.name','posts.*')
              ->where('status','publish')
              ->orderBy('updated_at', 'desc')
              ->orderBy('created_at', 'desc')
              ->paginate($pagination);

        return Post::where('owner_id',$loggedID)
            ->orderBy('updated_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate($pagination);

    }

    /**
     *
     *
     *
     */
    public static function getPostById($id){

       return Post::findOrFail($id);

    }

    /**
     *
     *
     *
     */
    public static function storePost($post){

        $post = Post::create($post);

        return $post;
    }

    /**
     *
     *
     *
     */
    public static function updatePost($post){

        return $post->save();

    }

    /**
     *
     *
     *
     */
    public static function destroy($id){

        $post = Post::withTrashed()->findOrFail($id);

        return $post->delete();

    }

}
