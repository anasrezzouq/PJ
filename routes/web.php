
<?php
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/home', [UserController::class, 'type'])->name('user.home');

    // Routes accessible only to admin users (type 1)
    Route::middleware(['checkUserType:1'])->group(function () {
        Route::resource('tasks', TaskController::class)->except(['index', 'show']);
        Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
        

        // Blog routes accessible only to admin users (type 1)
        Route::resource('tasks', TaskController::class)->only(['index', 'create', 'store']);
    });

    // Routes accessible to all authenticated users
    Route::post('/tasks/{taskId}/toggle-like', [LikeController::class, 'toggleLike'])->name('tasks.toggleLike');
    
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::post('/tasks/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::patch('/comments/', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    // Profile routes accessible to all authenticated users
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard/filter', [DashboardController::class, 'filter'])->name('dashboard.filter');
Route::get('/email/verify', function () {
    return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');
    
 Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/home');
        })->middleware(['auth', 'signed'])->name('verification.verify');

require __DIR__.'/auth.php';
