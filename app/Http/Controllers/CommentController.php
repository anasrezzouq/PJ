<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Comment;

class CommentController extends Controller
{
    public function edit($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        // You can add any additional logic here if needed
        return view('comments.edit', compact('comment'));
    }
    public function store(Request $request, $taskId)
    {
        $request->validate([
            'comment' => 'required|string|max:200',
        ]);

        $task = Task::findOrFail($taskId);

        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->comment = $request->comment;
        $comment->task_id = $task->id;
        $comment->save();

        return redirect()->route('tasks.show', $task->id)->with('success', 'Comment added successfully.');
    }
    public function update(Request $request, $commentId)
    {
        $request->validate([
            'comment' => 'required|string|max:200',
        ]);

        $comment = Comment::findOrFail($commentId);
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->back()->with('success', 'Comment updated successfully.');
    }
    public function destroy($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
