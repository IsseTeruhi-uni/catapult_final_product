<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\MeetingAttendanceController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrController;
use App\Http\Controllers\TweetController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/follow/followers_show/{id}', [FollowController::class, 'followers_show'])->name('follow.show1');
    Route::get('/follow/followings_show/{id}', [FollowController::class, 'followings_show'])->name('follow.show2');
    Route::get('/tweet/timeline', [TweetController::class, 'timeline'])->name('tweet.timeline');
    Route::resource('tweet', TweetController::class);
    Route::post('user/{user}/follow', [FollowController::class, 'store'])->name('follow');
    Route::post('user/{user}/unfollow', [FollowController::class, 'destroy'])->name('unfollow');
    Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/search/input', [SearchController::class, 'create'])->name('search.input');
    Route::get('/search/result', [SearchController::class, 'index'])->name('search.result');
    Route::resource('employees', EmployeeController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
});

Route::prefix('meeting')->middleware('auth')->group(function () {

    Route::get('create', [MeetingController::class, 'create'])->name('meeting.create');
    Route::post('store', [MeetingController::class, 'store'])->name('meeting.store');
    Route::get('index', [MeetingController::class, 'index'])->name('meeting.index');
});

Route::prefix('meeting_attendance')->middleware(['auth', 'is_invited_user'])->group(function () {

    Route::get('{meeting}/edit', [MeetingAttendanceController::class, 'create'])->name('meeting_attendance.edit');
    Route::put('update/{meeting}', [MeetingAttendanceController::class, 'update'])->name('meeting_attendance.update');
});


Route::get('/create', [QrController::class, 'create'])->name('create');

Route::get('/home', [QrController::class, 'home'])->name('home');

Route::post('/generate', [QrController::class, 'generate'])->name('generate');

require __DIR__ . '/auth.php';
