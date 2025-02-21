<?php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\CategoryController as UICategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\PostController as UIPostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/category/{slug}', [UICategoryController::class, 'show'])->name('category.show');


Route::get('/post/{slug}', [UIPostController::class, 'show'])->name('post.show');
Route::get('/posts', [UIPostController::class, 'index'])->name('posts.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth', 'role:admin,editor'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/posts', PostController::class)->except(['destroy']);
});


// sadece admin, post silme yetkisine sahip
Route::delete('/admin/posts/{post}', [PostController::class, 'destroy'])->middleware('role:admin')->name('admin.posts.destroy');


Route::middleware(['auth', 'role:admin'])->prefix('admin/categories')->name('admin.categories.')->group(function () {
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
});

// editor kategorileri sadece goruntuleyebilir.
Route::middleware(['auth', 'role:admin,editor'])->prefix('admin/categories')->name('admin.categories.')->group(function () {
   Route::get('/', [CategoryController::class, 'index'])->name('index');
});


