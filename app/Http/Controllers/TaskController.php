<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query tasks with optional category filter
        $query = Task::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $tasks = $query->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate incoming request data
    $data = $request->validate([
        'title' => 'required|max:100',
        'detail' => 'required|max:50000',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'category' => 'required|string',
    ]);

    // Store image if present
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $data['image_path'] = $imagePath;
    }

    // Create and save the new task
    Task::create($data);

    return redirect()->back()->with('message', 'Le Blog a bien été créée !');
}

    /**
     * Display the specified resource.
     */

     public function show(Task $task)
{
    // Get the like count for the task
    $likesCount = $task->jaimes()->count();

    // Pass the task and likes count to the view
    return view('tasks.show', compact('task', 'likesCount'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Validate incoming request data
        $data = $request->validate([
            'title' => 'required|max:100',
            'detail' => 'required|max:50000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'category' => 'required|string',
        ]);

        // Handle image upload and deletion
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($task->image_path) {
                Storage::disk('public')->delete($task->image_path);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image_path'] = $imagePath;
        }

        // Update task details
        $task->update($data);

        return back()->with('message', 'Le Blog a bien été modifiée !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Delete the task
        $task->delete();

        // Redirect to the tasks index page with a success message
        return redirect()->route('tasks.index')->with('success', 'Blog deleted successfully.');
    }
}
