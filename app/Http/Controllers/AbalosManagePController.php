<?php

namespace App\Http\Controllers;

use App\Models\Post; // Assuming you have a Post model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // Import the Mail facade
use App\Mail\PostStatusUpdated; // Import your Mailable class

class AbalosManagePController extends Controller
{
    public function home(Request $request) // Changed index to home
    {
        // Get the filter input
        $filter = $request->input('filter');

        // Retrieve posts with pagination, filtering only for pending status
        $posts = Post::when($filter, function($query, $filter) {
            return $query->where('status', 'pending') // Filter for pending status
                         ->where(function($query) use ($filter) {
                             $query->where('title', 'like', "%{$filter}%")
                                   ->orWhere('content', 'like', "%{$filter}%");
                         });
        }, function($query) {
            return $query->where('status', 'pending'); // Default to only pending posts
        })->paginate(10);

        return view('christianabalosMP', compact('posts'));
    }

    public function updateStatus(Request $request, $id)
{
    $post = Post::findOrFail($id);
    $status = $request->input('status');

    // Update the post status
    $post->status = $status;

    // Update the 'del' field based on the status
    if ($status === 'accepted') {
        $post->del = true; // Set del to true (on) when accepted
    } else {
        $post->del = false; // Set del to false (off) when rejected
    }

    $post->save();

    // Prepare the email message
    $message = $status === 'accepted'
    ? "Your post titled '{$post->title}' has been accepted."
    : "Your post titled '{$post->title}' has been rejected.";

Mail::to($post->user->email)->send(new PostStatusUpdated($message, $post->title));


    return redirect()->route('posts.home')->with('success', 'Post status updated successfully.');
}


}




