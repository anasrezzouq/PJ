<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class UserController extends Controller
{
    public function type()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == '0') {
                return view('user.home');
            } else {
                return redirect()->route('tasks.index');
            }
        } else {
            return redirect()->back();
        }
    }

    public function index()
    {
        // Fetch tasks from the database
        $tasks = Task::all();

        // Return the view with tasks
        return view('user.home', compact('tasks'));
    }
}
