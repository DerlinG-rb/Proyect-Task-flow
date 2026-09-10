<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        // TODO(sesion-05): borra la línea de abajo y descomenta el bloque completo.
        //return TaskResource::collection(Task::all());
         return TaskResource::collection($request->user()->tasks);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pendiente,en_progreso,completada',
        ]);

        // TODO(sesion-05): borra la línea de abajo y descomenta el bloque completo.
        //$task = Task::create($validated);
        $task = $request->user()->tasks()->create($validated);
        return new TaskResource($task);
    }

    public function show(Request $request, $id)
    {
        // TODO(sesion-05): borra la línea de abajo y descomenta la línea real.
        //$task = Task::findOrFail($id);
        $task = $request->user()->tasks()->findOrFail($id);
        return new TaskResource($task);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pendiente,en_progreso,completada',
        ]);

        // TODO(sesion-05): borra la línea de abajo y descomenta la línea real.
        //$task = Task::findOrFail($id);
        $task = $request->user()->tasks()->findOrFail($id);
        $task->update($validated);
        return new TaskResource($task);
    }

    public function destroy(Request $request, $id)
    {
        // TODO(sesion-05): borra la línea de abajo y descomenta la línea real.
        //$task = Task::findOrFail($id);
        $task = $request->user()->tasks()->findOrFail($id);
        $task->delete();
        return response()->json(null, 204);
    }
}
