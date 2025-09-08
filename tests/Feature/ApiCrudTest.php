<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_animales_update_and_delete()
    {
        // Create
        $create = $this->postJson('/api/animales', [
            'especie' => 'Vaca',
            'raza' => 'Holstein',
            'alimentacion' => 'Pasto',
            'cuidados' => 'Vacunas',
            'reproduccion' => 'Natural'
        ])->assertCreated();
        $id = $create->json('id');
        $this->assertNotEmpty($id);

        // Update (PATCH)
        $this->patchJson("/api/animales/{$id}", [
            'raza' => 'Holstein'
        ])->assertOk()->assertJsonPath('raza', 'Holstein');

        // Delete
        $this->deleteJson("/api/animales/{$id}")->assertNoContent();
        $this->getJson("/api/animales/{$id}")->assertNotFound();
    }

    public function test_vegetales_update_and_delete()
    {
        $create = $this->postJson('/api/vegetales', [
            'especie' => 'Tomate',
            'cultivo' => 'Invernadero'
        ])->assertCreated();
        $id = $create->json('id');

        $this->patchJson("/api/vegetales/{$id}", [
            'cultivo' => 'A cielo abierto'
        ])->assertOk()->assertJsonPath('cultivo', 'A cielo abierto');

        $this->deleteJson("/api/vegetales/{$id}")->assertNoContent();
        $this->getJson("/api/vegetales/{$id}")->assertNotFound();
    }

    public function test_preparados_update_and_delete()
    {
        $create = $this->postJson('/api/preparados', [
            'nombre' => 'Biol',
            'preparacion' => 'Fermentado'
        ])->assertCreated();
        $id = $create->json('id');

        $this->patchJson("/api/preparados/{$id}", [
            'preparacion' => 'Fermentado'
        ])->assertOk()->assertJsonPath('preparacion', 'Fermentado');

        $this->deleteJson("/api/preparados/{$id}")->assertNoContent();
        $this->getJson("/api/preparados/{$id}")->assertNotFound();
    }

    public function test_fincas_update_and_delete()
    {
        $create = $this->postJson('/api/fincas', [
            'nombre' => 'El Prado',
            'ubicacion' => 'Rionegro',
            'propietario' => 'Juan'
        ])->assertCreated();
        $id = $create->json('id');

        $this->patchJson("/api/fincas/{$id}", [
            'ubicacion' => 'Rionegro'
        ])->assertOk()->assertJsonPath('ubicacion', 'Rionegro');

        $this->deleteJson("/api/fincas/{$id}")->assertNoContent();
        $this->getJson("/api/fincas/{$id}")->assertNotFound();
    }

    // 422 validation tests for required fields
    public function test_animales_requires_especie_on_store()
    {
        $this->postJson('/api/animales', [])->assertStatus(422)
            ->assertJsonStructure(['errors' => ['especie']]);
    }

    public function test_vegetales_requires_especie_on_store()
    {
        $this->postJson('/api/vegetales', [])->assertStatus(422)
            ->assertJsonStructure(['errors' => ['especie']]);
    }

    public function test_preparados_requires_nombre_on_store()
    {
        $this->postJson('/api/preparados', [])->assertStatus(422)
            ->assertJsonStructure(['errors' => ['nombre']]);
    }

    public function test_fincas_requires_nombre_and_propietario_on_store()
    {
        $this->postJson('/api/fincas', [])->assertStatus(422)
            ->assertJsonStructure(['errors' => ['nombre']]);

        $this->postJson('/api/fincas', ['nombre' => 'X'])->assertStatus(422)
            ->assertJsonStructure(['errors' => ['propietario']]);
    }
}
