<?php

use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(
        [
            'middleware' => [
                'role:SuperAdmin',
            ],
        ],
        function () {

            /** User CRUD */
            Route::resource('users', UserController::class);
            /** Form CRUD */
            Route::resource(name: 'forms', controller: FormController::class);
            Route::get('forms/{id}/messages', [FormController::class, 'getMessageFromUser'])->name('forms.messages');

            /** Message CRUD */
            Route::resource(name: 'messages', controller: MessageController::class);
        }
    );
});

require __DIR__.'/auth.php';
