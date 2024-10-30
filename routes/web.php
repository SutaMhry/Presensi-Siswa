<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\PermitController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassroomController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/', 'authenticate');
});

Route::get('/profile', [UserController::class, 'index'])->name('profile');

Route::middleware(['auth'])->group(function() {

// Student Routes 
    Route::middleware(['role:student'])->group(function () {
        Route::controller(PresenceController::class)->group(function () {
            Route::get('/studentdash', 'dash')->name('studentdash');
            Route::get('/presencestudent', 'presence')->name('presencestudent');
            Route::post('/presencestudent', 'store');
            Route::get('/presences',  'fetchPresenceMonthly');
        });

        Route::controller(PermitController::class)->group(function () {
            Route::get('/permit', 'index')->name('permit');
            Route::post('/permit', 'store');
        });


        Route::get('/assignment', function () {
            return view('assignment.assignment');
        })->name('assignment');
        Route::get('/comunication-student', function () {
            return view('comunication.message-student');
        })->name('comunication-student');

    });


// Teacher Routes
    Route::middleware(['role:teacher'])->group(function () {
        Route::controller(PresenceController::class)->group(function () {
            Route::get('/teacherdash', 'teacherdash')->name('teacherdash');
            Route::get('/students-attendance', 'studentsattendance')->name('students-attendance');
        });

        Route::get('/comunication-teacher', function () {
            return view('comunication.message-teacher');
        })->name('comunication-teacher');
        Route::get('/send-message', function () {
            return view('comunication.send');
        })->name('send-message');
        Route::get('/class', [ClassroomController::class, 'index'])->name('class');

    });


// Admin Routes
    Route::middleware(['role:admin'])->group(function () {
        Route::controller(PresenceController::class)->group(function () {
            Route::get('/admindash', 'admindash')->name('admindash');
            Route::post('admindash', 'destroy');
        });

        Route::controller(ClassroomController::class)->group(function () {
            Route::get('/class-management', 'index')->name('classroom-management');
            Route::get('/teacher-management', 'teacher')->name('teacher-management');
            Route::get('/class-detail/{name}', 'detail')->name('classroom-detail');
            Route::get('/create-classroom', 'create')->name('create-classroom');
            Route::post('/create-classroom-process', 'store')->name('create-classroom-process');

            Route::get('/edit-classroom/{id}', 'editClassroom')->name('edit-classroom');
            Route::post('/edit-classroom-process/{id}', 'update')->name('edit-classroom-process');

            Route::delete('/hapus-classroom/{id}', 'destroy')->name('hapus-classroom');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('/admin-management', 'admin')->name('admin-management');
            Route::get('/student-management', 'student')->name('student-management');

            Route::get('/create-admin', 'create')->name('create-admin');
            Route::get('/create-teacher', 'create')->name('create-teacher');
            Route::get('/create-student', 'create')->name('create-student');
            Route::post('/create-user-process', 'store')->name('create-user-process');

            Route::get('/edit/{id}', 'edit')->name('edit-user');
            Route::post('/edit-user-process/{id}', 'update')->name('edit-user-process');
            
            Route::delete('/hapus/{id}', 'destroy')->name('hapus-data');
        });
    });

});