<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

  public function test_index_devuelve_200_con_la_coleccion_de_tareas(): void
{
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    Task::factory()->count(3)->for($user)->create();

    $response = $this->getJson('/api/tasks');

    $response->assertStatus(200)->assertJsonCount(3, 'data');
}

public function test_store_con_datos_invalidos_devuelve_422(): void
{
    Sanctum::actingAs(User::factory()->create());

    $response = $this->postJson('/api/tasks', []);

    $response->assertStatus(422);
}

public function test_store_con_datos_validos_crea_la_tarea_y_devuelve_201(): void
{
    Sanctum::actingAs(User::factory()->create());

    $response = $this->postJson('/api/tasks', [
        'title' => 'Escribir tests de la API',
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('tasks', ['title' => 'Escribir tests de la API']);
}
    public function test_un_usuario_no_puede_ver_la_tarea_de_otro(): void
    {
        // TODO(sesion-05): borra el markTestIncomplete() de abajo y descomenta el bloque completo.
        //$this->markTestIncomplete('Reemplaza este placeholder en la Sesión 5.');
        $userA = User::factory()->create();
        $userB = User::factory()->create();
         Sanctum::actingAs($userA);
         $tareaDeB = Task::factory()->for($userB)->create();
        
         $response = $this->getJson("/api/tasks/{$tareaDeB->id}");
        
         $response->assertStatus(404);
    }
}
