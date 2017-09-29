<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;

class PostController extends Controller
{

    public function __construct() {

    }

     /**
	  * Display a listing of the Articles
	  *
	  * @return \Illuminate\Http\Response
	  */
	  protected function index(){

        $posts = Post::getPosts(\Auth::user()->id);

        return view('post.list', ['posts' => $posts]);

    }

    /**
	  * Show the form for creating a new Article
	  *
	  * @return \Illuminate\Http\Response
	  */
	  protected function create(){

        return view('post.register');

	  }

    /**
	  * Store a newly created Article in database.
	  *
	  * @param  \Illuminate\Http\Request  $request
	  * @return \Illuminate\Http\Response
	  */
	  protected function store(Requests\PostCreateRequest $request){

    		$post = [

    				'title' => \Input::get('title'),

    				'slug' => str_slug(\Input::get('slug'), '_'),

    				'contents' => \Input::get('contents'),

            'owner_id' => \Auth::user()->id,

            'status' => \Input::get('status'),

    				'updated_user_id' => \Input::get('updated_user_id'),

    		];

    		$post = Post::storePost($post);

        \Session::flash('flash_message','successfully saved.');

        return redirect()->route("post.lists");

    }

    /**
    * Display the specified Article.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  	protected function read($id){

        return view('post.content');

    }

      /**
  	 * Show the form for editing the specified Article.
  	 *
  	 * @param  int  $id
  	 * @return \Illuminate\Http\Response
  	 */
  	protected function edit($id){

          $post = Post::getPostById($id);

          return view('post.edit', ['post' => $post ]);

  	}

      /**
  	 * Update the specified Article in storage.
  	 *
  	 * @param  \Illuminate\Http\Request  $request
  	 * @param  int  $id
  	 * @return \Illuminate\Http\Response
  	 */
  	protected function update(Requests\PostEditRequest $request, $id){

    		$post = Post::getPostById($id);

    		$post->title = \Input::get('title');

    		$post->slug = str_slug(\Input::get('slug'), '_');

    		$post->contents = \Input::get('contents');

      	$post->status = \Input::get('status');

    		$post->updated_user_id = \Input::get('updated_user_id');

    		$user = Post::updatePost($post);

        \Session::flash('flash_message','successfully saved.');

        return redirect()->route("post.lists");
    }

      /**
  	 * Remove the specified Article from storage.
  	 *
  	 * @param  int  $id
  	 * @return \Illuminate\Http\Response
  	 */
  	protected function delete(Requests\PostDeleteRequest $request){

          $post = Post::destroy($request['id']);

          \Session::flash('flash_message','successfully deleted.');

          return redirect()->route("post.lists");

    }
}
