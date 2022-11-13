<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Modules\Blog\Entities\Comment;
use Modules\Blog\Entities\Post;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $posts =Post::all();
        return view('blog::index',compact('posts'));
    }
public function create_post(){
    return view('blog::create');
}
    public function store_post(Request $request){
      $validator = Validator::make($request->all(), [
            'title' => 'required',
            'descreption' => 'required|min:20',
            'status' => 'required',
        ]);


        if($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file_name = $request->image->hashName();

        $path = 'images';
        $request->image->move($path, $file_name);

        $data['title'] = $request->title;
        $data['user_id'] = auth()->user()->id;
        $data['descreption'] = $request->descreption;
        $data['status'] = $request->status;
        $data['image'] = $file_name;

       Post::create($data);
        return redirect('dashboard/index');

    }
    public function comment(Request $request, $id){

        Comment::create([
            'status' => 1,
            'comment' => $request->comment,
            'post_id' => $id,
            'user_id' =>auth()->user()->id

        ]);
        return redirect('dashboard/index');
    }
    public function comments(Post $post){

        $comments = $post->comments;
      
        return view('blog::comments',compact('comments'));
    }

}

