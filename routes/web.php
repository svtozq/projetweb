<?php

use App\Http\Controllers\CohortController;
use App\Http\Controllers\CommonLifeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RetroController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

// Redirect the root path to /dashboard
Route::redirect('/', 'dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('verified')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Cohorts
        Route::get('/cohorts', [CohortController::class, 'index'])->name('cohort.index');
        Route::post('/cohort/create', [CohortController::class, 'create'])->name('cohort.create');
        Route::get('/cohort/{cohort}', [CohortController::class, 'show'])->name('cohort.show');
        Route::get('/cohort/{cohort}/delete', [CohortController::class, 'delete'])->name('cohort.delete');

        // Teachers
        Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher.index');
        Route::post('/teacher/create', [StudentController::class, 'create'])->name('teacher.create');
        Route::get('/teachers/{teacherId}/delete', [TeacherController::class, 'delete'])->name('teacher.delete');
        Route::put('/teachers/{teacherId}/update', [StudentController::class, 'update'])->name('teacher.update');

        // Students
        Route::get('/students', [StudentController::class, 'index'])->name('student.index');
        Route::post('/student/create', [StudentController::class, 'create'])->name('student.create');
        Route::get('/student/{studentId}/delete', [StudentController::class, 'delete'])->name('student.delete');
        Route::put('/student/{studentId}/update', [StudentController::class, 'update'])->name('student.update');

        // Knowledge
        Route::get('/knowledge', [KnowledgeController::class, 'index'])->name('knowledge.index');
        Route::put('/knowledge/{skillId}/learning', [KnowledgeController::class, 'skillLearning'])->name('skill.learning');
        Route::put('/knowledge/{skillId}/learnt', [KnowledgeController::class, 'skillLearnt'])->name('skill.learnt');

        // Groups
        Route::get('/groups', [GroupController::class, 'index'])->name('group.index');

        // Retro
        route::get('/retros', [RetroController::class, 'index'])->name('retro.index');
        Route::get('/retros/{cohort}', [RetroController::class, 'show'])->name('retro.show');

        // Common life
        Route::get('/common-life', [CommonLifeController::class, 'index'])->name('common-life.index');
        Route::put('/task/{taskId}/done', [CommonLifeController::class, 'taskDone'])->name('task.done');

    });

});

require __DIR__.'/auth.php';
