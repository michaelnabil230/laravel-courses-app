<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\StudentController;
use App\Http\Controllers\Dashboard\TrainerController;
use App\Http\Controllers\Dashboard\WelcomeController;
use App\Http\Controllers\Dashboard\LocationController;
use App\Http\Controllers\Dashboard\MessengerController;
use App\Http\Controllers\Dashboard\GlobalSearchController;
use App\Http\Controllers\Dashboard\Setting\BackupController;
use App\Http\Controllers\Dashboard\Setting\SettingController;
use App\Http\Controllers\Dashboard\Setting\AuditLogController;

use App\Http\Controllers\Dashboard\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Dashboard\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Dashboard\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Dashboard\Auth\NewPasswordController;
use App\Http\Controllers\Dashboard\Auth\PasswordResetLinkController;
use App\Http\Controllers\Dashboard\Auth\RegisteredUserController;
use App\Http\Controllers\Dashboard\Auth\VerifyEmailController;

Route::middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::middleware(['auth:admin', 'role:admin|super-admin'])->group(function () {
    Route::get('/', WelcomeController::class)->name('welcome');
    Route::get('global-search', GlobalSearchController::class)->name('globalSearch');

    Route::middleware('role:super-admin')->prefix('setting/')->name('setting.')->group(function () {

        // Settings
        Route::view('/', 'dashboard.setting.settings.index')->name('index');
        Route::post('/update', [SettingController::class, 'update'])->name('update');

        // Audit Logs
        Route::resource('audit-logs', AuditLogController::class)->only(['index', 'show']);

        // Backups
        Route::prefix('backups')
            ->name('backups.')
            ->controller(BackupController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/create', 'create')->name('create');
                Route::post('/delete', 'delete')->name('delete');
            });
    });

    // Students
    Route::resource('students', StudentController::class);

    // Users
    Route::resource('users', UserController::class)->except(['show']);

    // Locations
    Route::resource('locations', LocationController::class)->except(['show']);

    // Trainers
    Route::resource('trainers', TrainerController::class)->except(['show']);

    // Courses
    Route::resource('courses', CourseController::class)->except(['show']);

    // Courses of students
    Route::resource('courses.students', App\Http\Controllers\Dashboard\Student\CourseController::class)->except(['show', 'update', 'edit']);

    // Admins
    Route::resource('admins', AdminController::class)->except(['show']);

    // Messenger
    Route::prefix('messenger')
        ->name('messenger.')
        ->controller(MessengerController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'createTopic')->name('createTopic');
            Route::post('/', 'storeTopic')->name('storeTopic');
            Route::get('/inbox', 'showInbox')->name('showInbox');
            Route::get('/outbox', 'showOutbox')->name('showOutbox');
            Route::get('/{topic}', 'showMessages')->name('showMessages');
            Route::delete('/{topic}', 'destroyTopic')->name('destroyTopic');
            Route::post('/{topic}/reply', 'replyToTopic')->name('reply');
            Route::get('/{topic}/reply', 'showReply')->name('showReply');
        });

    // Profile
    Route::prefix('profile')
        ->name('profile.')
        ->controller(ChangeProfileController::class)
        ->group(function () {
            Route::view('/', 'dashboard.profile.edit')->name('edit');
            Route::post('/password', 'updatePassword')->name('password.update');
            Route::post('/info', 'updateProfile')->name('info.update');
            Route::delete('/destroy', 'destroy')->name('destroy');
        });
});
