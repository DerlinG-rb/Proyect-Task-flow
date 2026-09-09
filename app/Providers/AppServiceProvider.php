<?php

namespace App\Providers;

use App\Models\Task;
use App\Observers\TaskObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // TODO(sesion-03): registra el TaskObserver para que se dispare
        // automáticamente en cada cambio de una Task. Pista: Task::observe(...).
    Task::observe(TaskObserver::class);
    }
}
