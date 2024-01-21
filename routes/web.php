<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobFieldController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Company;
use App\Models\JobField;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

    $jobpost = DB::table('posts');
    if (request('company') != null && request('company') != '-') {
        $jobpost = $jobpost
            ->where('company_id', '=', request('company'));
    }
    if (request('jobfield') != null && request('jobfield') != '-') {
        $jobpost = $jobpost
            ->where('job_field_id', '=',  request('jobfield'));
    }
    if (request('search') != null && request('search') != '#') {
        $jobpost = $jobpost
            ->where('job_title', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') .  '%');
    }
    //dd($jobpost);
    $jobpost = $jobpost->paginate(6);

    $companies = Company::all();
    $jobfields = JobField::all();

    return view('welcome', compact('companies', 'jobfields', 'jobpost'));
})->name('welcome');

Route::get('/post/{post}/show', [PostController::class, 'show'])->name('post.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
    Route::post('/company', [CompanyController::class, 'store'])->name('company.store');
    Route::get('/company/create', [CompanyController::class, 'create'])->name('company.create');
    Route::post('/company/{company}', [CompanyController::class, 'update'])->name('company.update');
    Route::get('/company/{id}/edit', [CompanyController::class, 'edit'])->name('company.edit');
    Route::delete('/company/{company}', [CompanyController::class, 'destroy'])->name('company.destroy');
    Route::get('/company/{company}', [CompanyController::class, 'show'])->name('company.show');

    Route::get('/jobfield', [JobFieldController::class, 'index'])->name('jobfield.index');
    Route::post('/jobfield', [JobFieldController::class, 'store'])->name('jobfield.store');
    Route::get('/jobfield/create', [JobFieldController::class, 'create'])->name('jobfield.create');
    Route::post('/jobfield/{jobfield}', [JobFieldController::class, 'update'])->name('jobfield.update');
    Route::get('/jobfield/{jobfield}/edit', [JobFieldController::class, 'edit'])->name('jobfield.edit');
    Route::delete('/jobfield/{jobfield}', [JobFieldController::class, 'destroy'])->name('jobfield.destroy');
    Route::get('/jobfield/{jobfield}', [JobFieldController::class, 'show'])->name('jobfield.show');

    Route::get('/post', [PostController::class, 'index'])->name('post.index');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/{post}', [PostController::class, 'update'])->name('post.update');
    Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::get('/post/{company}', [PostController::class, 'list'])->name('post.list');
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

    Route::get('/user', [ProfileController::class, 'index'])->name('user.index');
    Route::get('/user/{id}/edit', [ProfileController::class, 'adminedit'])->name('user.edit');
    Route::get('/user/show', [ProfileController::class, 'show'])->name('user.show');
    Route::delete('/user/{user}', [ProfileController::class, 'admindestroy'])->name('user.admindestroy');
    Route::patch('/user/{user}', [ProfileController::class, 'adminupdate'])->name('user.adminupdate');
    Route::get('user-datatables', function () {
        return view('datatable');
    });
});
require __DIR__ . '/auth.php';
