<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Mail\PostStored;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Events\PostCreatedEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PostCreatedNotification;

class HomeController extends Controller
{
    public function __construct() {
        // $this->middleware('auth')->except('posts', 'create');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        // $data1 = [];
        // foreach($posts as $post){
        //     $data1 = $post->name;
        // }
        // dd($data1);

        // $posts = Post::pluck('name');
        // $collection = collect([1, 2, 3])->map(function ($num) {
        //     return $num > 2;
        // });
        // $data = Post::all();
        // dd(config('apservice.info.third'));

        // $user = User::find(1);
        // $user->notify(new PostCreatedNotification());
        // Notification::send(User::find(1), new PostCreatedNotification());
        // echo 'Noti sent'; exit();

        // Mail::raw('Hello World', function($msg) {
        //     $msg->to('sumon25399@gmail.com')->subject('AP index function');
        // });
        $data = Post::where('user_id', auth()->id())->orderBy('id')->get();
        // $data = Post::latest()->first();

        return view('home', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $post = Post::create($validated + ['user_id' => Auth::user()->id]);
        event(new PostCreatedEvent($post));
        return redirect('/posts')->with('status', config('apservice.message.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // $post = Post::findOrFail($id);
        // if($post->user_id != auth()->id()){
        //     abort(403);
        // }

        $this->authorize('view', $post);
        $post->categories();
        return view('show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post->user_id != auth()->id()){
            abort(403);
        }
        $categories = Category::all();
        return view('edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $validated = $request->validated();
        $post->update($validated);
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, $id)
    {
        $post->delete($id);
        return redirect('/posts');
    }
}
