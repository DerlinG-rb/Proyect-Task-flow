<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // TODO(sesion-04): borra la línea de abajo y descomenta el bloque completo.
        //return response()->json([]);
        return TaskResource::collection(Task::all());
    }

    public function store(Request $request)
    {
        // TODO(sesion-04): borra la línea de abajo y descomenta el bloque completo.
        //return response()->json(null, 501);
         $validated = $request->validate([
             'title' => 'required|string|max:255',
             'description' => 'nullable|string',
            'status' => 'in:pendiente,en_progreso,completada',
            'user_id' => 'required|exists:users,id',
        ]);
        
        $task = Task::create($validated);
        return new TaskResource($task);
    }

    public function show(Task $task)
    {
        // TODO(sesion-04): borra la línea de abajo y descomenta el bloque completo.
        //return response()->json(null, 501);
         return new TaskResource($task);
    }

    public function update(Request $request, Task $task)
    {
        // TODO(sesion-04): borra la línea de abajo y descomenta el bloque completo.
        //return response()->json(null, 501);
         $validated = $request->validate([
             'title' => 'sometimes|string|max:255',
             'description' => 'nullable|string',
             'status' => 'in:pendiente,en_progreso,completada',
        ]);
        
        $task->update($validated);
        return new TaskResource($task);
    }

    public function destroy(Task $task)
    {
        // TODO(sesion-04): borra la línea de abajo y descomenta el bloque completo.
        //return response()->json(null, 501);
        $task->delete();
        return response()->json(null, 204);
    }
}
