<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Mail\TestMail;
use App\Models\Post;
use App\Models\User;
use App\Notifications\TestNotification;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use ImageTrait;

    public function index()
    {
        $posts = Post::get();
        return view('posts.index' , compact('posts'));
    }
    
    public function create()
    {
        return view('posts.create');
    }

    public function edit($id)
    {
        $post = DB::table('posts')->find($id);
        return view('posts.edit' , compact('post'));
    }

    public function trashed_posts()
    {
        $posts = Post::onlyTrashed()->get();
        return view('posts.trashed_posts' , compact('posts'));
    }

    public function store(PostRequest $request)
    {
        // DB::table('posts')->insert([
        //     'title'=>$request->title,
        //     'body'=>$request->body,
        // ]);
        
        $validation = $request->validated();
        $image = $request->file('image')->getClientOriginalName();
        $request->file('image')->move('productimage' , $image);
        $validation['image'] = $image;
        Post::create($validation);

        
        #For_Trait
        // $validation = $request->validated();
        // $validation['image'] = $this->image($request , 'admins');
        // Post::create($validation);
        
        
        // $users = User::all()->except(Auth::id());
        // Mail::to(Auth::user())->send(new TestMail);
        // Notification::send($users , new TestNotification);

        return redirect()->route('posts')->with('success' , 'Post Added Successfully');
    }

    public function update($id , Request $request , $image)
    {
        $request->validate(['title'=>'required' , 'body'=>'required' , 'image'=>'image']);
        
        // $post = DB::table('posts')->where('id' , $id);
        $post = Post::find($id);
        
        $post->update([
            'title'=>$request->title,
            'body'=>$request->body,
        ]);

        if($request->file('image'))
        {
            $post->image = $request->file('image')->getClientOriginalName();
            $request->file('image')->move('productimage' , $post->image);
            $post->update();
            Storage::disk('public_uploads')->delete($image);
        }
        
        return back()->with('success' , 'Post Updated Successfully');
    }

    public function delete($id)
    {
        // DB::table('posts')->where('id' , $id)->delete();
        // Session::flash('success' , 'Post Deleted Successfully');
        Post::destroy($id);
        return back()->with('success' , 'Post Deleted Successfully');
    }

    public function forceDelete($id)
    {
        $post = Post::find($id);
        $post->forceDelete();
        return back()->with('success' , 'Posts Deleted Successfully');
    }
    
    public function restorePost($id)
    {
        $post = Post::withTrashed()->find($id);
        $post->restore();
        return redirect()->route('posts')->with('success' , 'Post Restored Successfully');
    }
    
    public function delete_all()
    {
        // DB::table('posts')->select('*')->delete();
        DB::table('posts')->delete();
        return back()->with('success' , 'Posts Deleted Successfully');
    }

    public function delete_truncate()
    {
        DB::table('posts')->truncate();
        return redirect()->route('posts')->with('success' , 'Posts Deleted By Truncated Successfully');
    }
}
