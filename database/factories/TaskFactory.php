<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        // TODO(sesion-03): define los datos de prueba de una tarea.
        // Debe incluir: title (frase corta), description (opcional, puede ser null),
        // status (uno de: pendiente, en_progreso, completada) y user_id (usar
        // User::factory() para crear el usuario dueño si no se pasa explícito).
       return [
        'title' => fake()->sentence(4),
        'description' => fake()->paragraph(),
        'status' => fake()->randomElement(['pendiente', 'en_progreso', 'completada']),
        'user_id' => User::factory(),
    ];
    }
}
