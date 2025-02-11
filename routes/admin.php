<?php

use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\Jobs\{Index,Create,Update};
use App\Livewire\Pages\Skills\{Index as SkillsIndex};
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/dashboard');

// Dashboard
Route::get('/dashboard', Dashboard::class)->name('dashboard');

// Skills
Route::get('/skills', SkillsIndex::class)->name('skills.index');

// Jobs
Route::get('/jobs', Index::class)->name('jobs.index');
Route::get('/jobs/create', Create::class)->name('jobs.create');
Route::get('/jobs/edit/{id}', Update::class)->name('jobs.update');
Route::get('/jobs/delete/{id}', [Index::class,'deleteJobPost'])->name('jobs.delete');

