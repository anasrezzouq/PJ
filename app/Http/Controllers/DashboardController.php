<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $tasks = Task::all();
        return view('dashboard', compact('tasks'));
    }
    public function filter(Request $request)
    {
        $category = $request->input('category');

        $tasks = Task::query();

        if ($category) {
            $tasks->where('category', $category);
        }

        $tasks = $tasks->get();

        return view('dashboard', compact('tasks'));
    }
    
}
