<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class AbalosEditPostController extends Controller
{
    // Display a listing of the posts
    public function index()
    {
        // Fetch all posts that are not marked as deleted
        $posts = Post::where('del', '1')->get();
        
        return view('christianabalosindex', compact('posts')); // View for listing posts
    }

    // Show the form for editing a specific post
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('christianabalosedit', compact('post')); // View for editing a post
    }

    // Update the specified post
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('manage.index')->with('success', 'Post updated successfully.');
    }

    // Soft delete the specified post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        // Change the 'del' status instead of permanently deleting the post
        $post->update(['del' => '0']); // or 'off' to restore
        
        return redirect()->route('manage.index')->with('success', 'Post deleted successfully.');
    }
}
