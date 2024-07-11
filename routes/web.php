<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\MessageController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Landing page
Route::get('/', function () {
    return view('landing.index');
})->name('landing');

// About us page
Route::get('/aboutus', function () {
    return view('landing.about_us');
})->name('aboutus');

// Authentication routes
Route::get('/login', [UsersController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UsersController::class, 'login']);

Route::get('/register', [UsersController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UsersController::class, 'register']);











Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [UsersController::class, 'logout'])->name('logout');

    Route::get('/home', [UsersController::class, 'home'])->name('home');

    // Create post route
    Route::get('/createPost', [PostsController::class, 'createPost'])->name('createPost');
    Route::post('/store', [PostsController::class, 'store'])->name('store');
    Route::get('/explore', [usersController::class, 'explore'])->name('explore');

    // Home route (authenticated users)
    Route::get('/home', [UsersController::class, 'home'])->name('home');
    Route::get('/edit', [UsersController::class, 'edit'])->name('edit');
    Route::post('/update', [UsersController::class, 'update'])->name('user.update');
    Route::get('/userPage', [UsersController::class, 'userPage'])->name('userPage');
    Route::delete('/posts/{id}', [PostsController::class, 'deletePst'])->name('psts.delete');
    Route::get('/message/{id}', [MessageController::class, 'home'])->name('message');
    Route::post('/message/send', [MessageController::class, 'store'])->name('message.send');
    Route::get('/showMessage', [MessageController::class, 'show'])->name('message.show');

    //admins route
    Route::delete('/admin/deletePost/{id}', [AdminsController::class, 'deletePost'])->name('admin.deletePost');
    Route::delete('/admin/deleteUser/{id}', [AdminsController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::delete('/admin/deleteAdmin/{id}', [AdminsController::class, 'deleteAdmin'])->name('admin.deleteAdmin');
    Route::post('/admin/adminAdd', [UsersController::class, 'addAdmin'])->name('admin.add');


    Route::get('/admin/{action}/{id?}/{usr_id?}', function ($action, $id = null, $usr_id = null) {
        // Check if the authenticated user is an admin (type === 1)
        if (auth()->check() && auth()->user()->type === 1) {
            switch ($action) {
                case 'dashboard':
                    return app(AdminsController::class)->index();
                case 'users':
                    return app(AdminsController::class)->AllUsers();
                case 'infoPost':
                    return app(AdminsController::class)->infoPost($id, $usr_id);
                case 'admins':
                    return app(AdminsController::class)->AllAdmins();
                case 'adminAdd':
                    return app(AdminsController::class)->adminAdd();
                default:
                    abort(404);
            }
        } else {
            abort(403, 'Unauthorized action.');
        }
    })->name('admin.dashboard');
});
