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
    Route::put('/profile/{user}/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'delete'])->name('profile.delete');

    Route::middleware('verified')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Cohorts
        Route::get('/cohorts', [CohortController::class, 'index'])->name('cohort.index');
        Route::post('/cohort/create', [CohortController::class, 'create'])->name('cohort.create');
        Route::get('/cohort/{cohortId}', [CohortController::class, 'show'])->name('cohort.show');
        Route::post('/cohort/{cohortId}/add/student', [CohortController::class, 'addStudent'])->name('cohort.add.student');
        Route::delete('/cohort/{cohortId}/delete/{studentId}', [CohortController::class, 'deleteStudent'])->name('cohort.delete.student');
        Route::get('/cohort/{cohortId}/delete', [CohortController::class, 'delete'])->name('cohort.delete');

        // Teachers
        Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher.index');
        Route::post('/teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
        Route::put('/teacher/update', [TeacherController::class, 'update'])->name('teacher.update');
        Route::get('/teacher/{teacherId}/delete', [TeacherController::class, 'delete'])->name('teacher.delete');


        // Students
        Route::get('/students', [StudentController::class, 'index'])->name('student.index');
        Route::post('/student/create', [StudentController::class, 'create'])->name('student.create');
        Route::put('/student/update', [StudentController::class, 'update'])->name('student.update');
        Route::get('/student/{studentId}/delete', [StudentController::class, 'delete'])->name('student.delete');


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
