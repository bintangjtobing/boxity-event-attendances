<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\ParticipantController as AdminParticipantController;
use App\Http\Controllers\Admin\AttendanceController as AdminAttendanceController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\AdminController as AdminAdminController;
use App\Http\Controllers\Admin\AuthorizationController as AdminAuthorizationController;
use App\Http\Controllers\PageController as PageControler;

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

Route::get('/', function () {
    return view('attendance');
});

//Admin
Route::prefix('/')->group(function () {
    Route::post('/', [AdminAuthController::class, 'processAttendance'])->name('admin_attendance_post');
    Route::get('/login', [AdminAuthController::class, 'viewLogin'])->name('admin_login_view');
    Route::post('/login', [AdminAuthController::class, 'processLogin']);
    Route::get('/logout', [AdminAuthController::class, 'processLogout'])->name('admin_logout');

    //Register Event
    Route::get('/register/{token}', [AdminEventController::class, 'register'])->name('events_register');
    Route::post('/register/{token}', [AdminEventController::class, 'processRegistration'])->name('event_processRegistration');

    Route::namespace('Admin')->middleware(['admin'])->group(function () {
        Route::prefix('/dashboard')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'view'])->name('dashboard_view_admin');
        });

        Route::prefix('/event')->group(function () {
            Route::get('/', [AdminEventController::class, 'view'])->name('event_view_index');
            Route::get('/data', [AdminEventController::class, 'data'])->name('event_view_data');
            Route::get('/add', [AdminEventController::class, 'addView'])->name('event_add_view');
            Route::get('/edit/{id}', [AdminEventController::class, 'editView'])->name('event_edit_view');
            Route::post('/add', [AdminEventController::class, 'addPost'])->name('event_add_post');
            Route::patch('/{id}', [AdminEventController::class, 'update'])->name('event_edit_patch');
            Route::delete('/delete/{id}', [AdminEventController::class, 'delete'])->name('event_delete_data');
        });

        Route::prefix('/participant')->group(function () {
            Route::get('/', [AdminParticipantController::class, 'view'])->name('participant_view_index');
            Route::get('/data', [AdminParticipantController::class, 'data'])->name('participant_view_data');
            Route::get('/add', [AdminParticipantController::class, 'addView'])->name('participant_add_view');
            Route::get('/edit/{id}', [AdminParticipantController::class, 'editView'])->name('participant_edit_view');
            Route::post('/import', [AdminParticipantController::class, 'import'])->name('participant_add_import');
            Route::post('/add', [AdminParticipantController::class, 'addPost'])->name('participant_add_post');
            Route::patch('/{id}', [AdminParticipantController::class, 'update'])->name('participant_edit_patch');
            Route::delete('/delete/{id}', [AdminParticipantController::class, 'delete'])->name('participant_delete_data');
        });

        Route::prefix('/attendance')->group(function () {
            Route::get('/', [AdminAttendanceController::class, 'view'])->name('attendance_view_index');
            Route::get('/data', [AdminAttendanceController::class, 'data'])->name('attendance_view_data');
            Route::get('/add', [AdminAttendanceController::class, 'addView'])->name('attendance_add_view');
            Route::get('/edit/{id}', [AdminAttendanceController::class, 'editView'])->name('attendance_edit_view');
            Route::post('/add', [AdminAttendanceController::class, 'addPost'])->name('attendance_add_post');
            Route::patch('/{id}', [AdminAttendanceController::class, 'update'])->name('attendance_edit_patch');
            Route::delete('/delete/{id}', [AdminAttendanceController::class, 'delete'])->name('attendance_delete_data');
        });

        Route::prefix('/certificate')->group(function () {
            Route::get('/', [PageControler::class, 'adminMaintenance'])->name('certificate_view_index');
            Route::get('/data', [PageControler::class, 'data'])->name('certificate_view_data');
            Route::get('/add', [PageControler::class, 'addView'])->name('certificate_add_view');
            Route::get('/edit/{id}', [PageControler::class, 'editView'])->name('certificate_edit_view');
            Route::post('/add', [PageControler::class, 'addPost'])->name('certificate_add_post');
            Route::patch('/{id}', [PageControler::class, 'update'])->name('certificate_edit_patch');
            Route::delete('/delete/{id}', [PageControler::class, 'delete'])->name('certificate_delete_data');
        });

        Route::prefix('/role')->group(function () {
            Route::get('/', [AdminRoleController::class, 'view'])->name('role_view_index');
            Route::get('/data', [AdminRoleController::class, 'data'])->name('role_view_data');
            Route::get('/add', [AdminRoleController::class, 'addView'])->name('role_add_view');
            Route::get('/edit/{id}', [AdminRoleController::class, 'editView'])->name('role_edit_view');
            Route::post('/add', [AdminRoleController::class, 'addPost'])->name('role_add_post');
            Route::patch('/{id}', [AdminRoleController::class, 'update'])->name('role_edit_patch');
            Route::delete('/delete/{id}', [AdminRoleController::class, 'delete'])->name('role_delete_data');
        });

        Route::prefix('/admin')->group(function () {
            Route::get('/', [AdminAdminController::class, 'view'])->name('admin_view_index');
            Route::get('/data', [AdminAdminController::class, 'data'])->name('admin_view_data');
            Route::get('/add', [AdminAdminController::class, 'addView'])->name('admin_add_view');
            Route::get('/edit/{id}', [AdminAdminController::class, 'editView'])->name('admin_edit_view');
            Route::post('/add', [AdminAdminController::class, 'addPost'])->name('admin_add_post');
            Route::patch('/{id}', [AdminAdminController::class, 'update'])->name('admin_edit_patch');
            Route::delete('/delete/{id}', [AdminAdminController::class, 'delete'])->name('admin_delete_data');
        });

        Route::prefix('/authorization')->group(function () {
            Route::get('/', [AdminAuthorizationController::class, 'view'])->name('authorization_view_index');
            Route::get('/data/{role}', [AdminAuthorizationController::class, 'data'])->name('authorization_view_data');
            Route::post('/', [AdminAuthorizationController::class, 'update'])->name('authorization_edit_patch');
        });
    });
});

Route::fallback(function () {
    return view('page.404');
});
