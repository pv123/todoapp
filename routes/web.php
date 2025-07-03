<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Str;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\PublicTaskLinkMail;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tasks', TaskController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
});

Route::get('/test-mail', function () {
    try {
        Mail::raw('To jest testowy e-mail z mailera laravel!', function ($message) {
            $message->to('p.antoniewicz@wp.pl')
                    ->subject('Test Laravel');
        });

        return 'Wiadomość wysłana!';
    } catch (\Exception $e) {
        return 'Błąd: ' . $e->getMessage();
    }
});

// Publiczne wyświetlenie zadania
Route::get('/tasks/public/{token}', function ($token) {
    $task = Task::where('public_token', $token)->firstOrFail();

    if ($task->public_token_expires_at && Carbon::parse($task->public_token_expires_at)->isPast()) {
        abort(403, 'Link wygasł.');
    }

    return view('tasks.public', compact('task'));
})->name('tasks.public');

// Generowanie tokenu

Route::post('/tasks/{task}/generate-token-custom', function (Request $request, Task $task) {
    $request->validate([
        'email' => 'required|email',
    ]);

    // Wygeneruj token i datę ważności jeśli nie istnieją
    if (!$task->public_token) {
        $task->public_token = Str::random(40);
        $task->public_token_expires_at = Carbon::now()->addDays(3);
        $task->save();
    }

    Mail::to($request->email)->send(new PublicTaskLinkMail($task));

    return back()->with('success', 'Link został wysłany na ' . $request->email);
})->name('tasks.token.generate.custom');

Route::post('/tasks/{task}/generate-token', function (App\Models\Task $task) {
    if (!$task->public_token) {
        $task->generatePublicToken();
    }

    // send email
    if ($task->user && $task->user->email) {
        Mail::to($task->user->email)->send(new PublicTaskLinkMail($task));
    }

    return back()->with('success', 'Public link was generated and send by email');
})->name('tasks.token.generate');

// Usuwanie tokenu
Route::delete('/tasks/{task}/revoke-token', function (Task $task) {
    $task->revokePublicToken();
    return back()->with('success', 'Link publiczny został usunięty.');
})->name('tasks.token.revoke');
