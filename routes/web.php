<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('login', [LoginController::class, 'create'])->name('login');
// Route::post('login', [LoginController::class, 'store'])->name('login');

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return inertia('Home');
    });
    Route::get('/users', function () {
        return inertia('Users/Index', [
            'users' => User::when(request('search'), function ($query, $sarch) {
                $query->where('name', 'like', '%' . $sarch . '%');
            })
                ->paginate()
                ->withQueryString()
                ->through(fn ($user) => [
                    'id' => $user->id,
                    'email' => $user->email,
                    'name' => $user->name,
                    'can' => [
                        'edit' => Auth::user()->can('edit', $user)
                    ]
                ]),

            'filter' => request()->only(['search']),
            'can' => [
                'createUser' => Auth::user()->can('create', User::class),
            ]
        ]);
    });
    Route::get('/users/create', function () {
        return inertia('Users/Create');
    })->middleware('can:create,App\Models\User');

    Route::get('/users/{id}/edit', function ($id) {
        return Inertia::render('Users/Edit', [
            'user' => User::findOrFail($id)
        ]);
    })->name('users.edit');

    Route::patch('/users/{id}/update', function ($id) {
        User::where('id', $id)->update([
            'name' => Request::input('name'),
            'email' => Request::input('email')
        ]);
        return redirect('/users')->with('success', 'User updated successfully');;
    });

    Route::post('/users/create', function () {
        $attributes = Request::validate([
            'name' => 'required',
            'email' => 'required | email',
            'password' => 'required | min:8'
        ]);
        User::create($attributes);

        return redirect('/users')->with('success', 'User created successfully');
    });
    Route::delete('/users/{id}/delete', function ($id) {
        User::where('id', $id)->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    })->name('users.delete');
    Route::get('/settings', function () {
        sleep(1);
        return inertia('Settings');
    });
    // Route::post('/logout', function () {
    //     Auth::logout();
    //     return redirect()->route('login');
    // });
});

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
