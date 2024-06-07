<?php

namespace App\Http\Controllers;

use App\Models\Jaime;
use App\Models\Task;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);
        $user = auth()->user();

        // Check if the user has already liked the task
        $existingLike = $task->jaimes()->where('user_id', $user->id)->first();

        if ($existingLike) {
            // If the user has already liked the task, remove the like
            $existingLike->delete();
            return back()->with('message', 'Task unliked successfully!');
        } else {
            // If the user has not already liked the task, add the like
            $like = new Jaime();
            $like->user_id = $user->id;
            $like->task_id = $task->id;
            $like->save();

            return back()->with('message', 'Task liked successfully!');
        }
    }
}
