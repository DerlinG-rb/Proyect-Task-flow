<?php

namespace App\Observers;

use App\Models\Task;
use Illuminate\Support\Facades\Log;

class TaskObserver
{
 public function updated(Task $task): void
{
    if ($task->wasChanged('status')) {
        Log::info("Tarea #{$task->id} cambió de estado", [
            'anterior' => $task->getOriginal('status'),
            'nuevo' => $task->status,
        ]);
    }
}
}
