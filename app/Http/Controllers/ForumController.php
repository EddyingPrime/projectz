<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Upvote;

class ForumController extends Controller
{
    public function getAllThreads()
    {
        $threads = Thread::with('comments')->get();
        return response()->json(['threads' => $threads]);
    }

    public function createThread(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);
    
        // Check if the user is authenticated
        if (auth()->check()) {
            // Get the user ID if authenticated
            $user_id = auth()->id();
    
            // Create a new thread associated with the authenticated user
            $thread = Thread::create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'user_id' => $user_id,
            ]);
    
            // Assuming you want to return the created thread as a JSON response
            return response()->json(['thread' => $thread], 201);
        } else {
            // Handle the case where the user is not authenticated
            return response()->json(['message' => 'User not authenticated'], 401);
        }
    }
    
    public function getThread($id)
    {
        $thread = Thread::with('comments')->find($id);

        if (!$thread) {
            return response()->json(['message' => 'Thread not found'], 404);
        }

        return response()->json(['thread' => $thread]);
    }

    public function createComment(Request $request, $threadId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);
    
        $thread = Thread::find($threadId);
    
        if (!$thread) {
            return response()->json(['message' => 'Thread not found'], 404);
        }
    
        $comment = $thread->comments()->create([
            'content' => $request->input('content'),
            'thread_id' => $request->input('thread_id'),
            'user_id' => auth()->id(),
        ]);

        $comment->save();
    
        return response()->json(['comment' => $comment], 201);
    }
    public function upVote($id)
    {
        $user = auth()->user();
    
        $thread = Thread::findOrFail($id);
    
        // Check if the user has already upvoted the thread
        if (!$user->upvotes()->where('thread_id', $thread->id)->exists()) {
            // User hasn't upvoted, create a new upvote record
            $upvote = new Upvote([
                'user_id' => $user->id,
                'thread_id' => $thread->id,
            ]);
    
            $upvote->save();
    
            // Update total upvotes count
            Upvote::where('thread_id', $thread->id)->increment('total_upvotes');
        $thread->save();
    
            return response()->json(['message' => 'Upvoted successfully']);
        }
    
        return response()->json(['message' => 'User has already upvoted this thread'], 403);
    }

    public function removeUpvote($id)
{
    $user = auth()->user();

    $thread = Thread::findOrFail($id);

    // Check if the user has upvoted the thread
    $upvote = $user->upvotes()->where('thread_id', $thread->id)->first();

    if ($upvote) {
        // User has upvoted, remove the upvote record
        $upvote->delete();

        // Update total upvotes count
        Upvote::where('thread_id', $thread->id)->decrement('total_upvotes');
        $thread->save();

        return response()->json(['message' => 'Upvote removed successfully']);
    }

    return response()->json(['message' => 'User has not upvoted this thread'], 403);
}

    public function getCommentsForThreads() {
        $threadIds = [1, 2, 3, 4, 5];
        $comments = Comment::whereIn('thread_id', $threadIds)->get();
    
        return response()->json($comments);
    }
}

