<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Created_at;

class AbalosAddPostController extends Controller
{
    public function create()
    {
        return view('christianabalosaddpost'); // View for creating a post
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
            'status' => 'pending',
            'del' => '1',
        ]);

        return redirect()->route('posts.create')->with('success', 'Post created successfully.');
    } 

    public function index()
    {
        $posts = Post::with('comments.user')
        ->where('status', 'accepted')
        ->where('del', '1') 
        ->get(); // Fetch posts with comments and users
        return view('christianabalosposts', compact('posts')); // View for listing posts
    }

    public function addComment(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        Comment::create([
            'post_id' => $postId,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    
}

    