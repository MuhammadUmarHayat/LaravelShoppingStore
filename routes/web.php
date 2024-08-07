<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
// routes/web.php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('loggedin')->group(function ()
 {
// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
// Registration Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register_user');
Route::get('adminregister', [RegisterController::class, 'showAdminRegistrationForm'])->name('admin_register_user');
Route::post('register', [RegisterController::class, 'register'])->name('store_user');

 }
);

//Admin working panel
Route::middleware('isadmin')->group(function ()
 {
    // Dashboard route
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Resource routes
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
});



Route::get('no-access',function()
{
echo "You are not allowed to acess this page";
});

//customer working panel
Route::middleware('islogin')->prefix('customer')->group(function () 
{
    Route::get('/', [CustomerController::class, 'index'])->name('customer.dashboard');
    Route::get('search', [CustomerController::class, 'search'])->name('product.search');
    Route::get('product/{id}', [CustomerController::class, 'show'])->name('product.show');
    
    Route::get('cart', [CustomerController::class, 'showCart'])->name('cart.show');
    Route::post('cart/add/{id}', [CustomerController::class, 'addToCart'])->name('cart.add');
    Route::post('cart/update/{id}', [CustomerController::class, 'updateCart'])->name('cart.update');
    Route::post('cart/delete/{id}', [CustomerController::class, 'deleteCart'])->name('cart.delete');
});


