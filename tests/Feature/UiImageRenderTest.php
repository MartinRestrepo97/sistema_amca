<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Animal;
use App\Models\Vegetal;
use App\Models\Preparado;
use App\Models\Finca;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UiImageRenderTest extends TestCase
{
    use RefreshDatabase;

    private function login(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    public function test_animales_view_renders_image_tag(): void
    {
        $this->login();

        $animal = Animal::create([
            'especie' => 'Canis lupus',
            'raza' => 'Labrador',
            'alimentacion' => 'Balanceado',
            'cuidados' => 'Vacunas al día',
            'reproduccion' => 'Esterilizado',
            'observaciones' => 'Amigable',
            'imagen' => '1_img.png',
        ]);

        $res = $this->get('/animales');
        $res->assertStatus(200);
        $res->assertSee('<img', false);
        $res->assertSee('img/animales/' . $animal->imagen, false);
    }

    public function test_vegetales_view_renders_image_tag(): void
    {
        $this->login();

        $vegetal = Vegetal::create([
            'especie' => 'Solanum lycopersicum',
            'cultivo' => 'Invernadero',
            'observaciones' => 'Riego diario',
            'imagen' => '2_img.png',
        ]);

        $res = $this->get('/vegetales');
        $res->assertStatus(200);
        $res->assertSee('<img', false);
        $res->assertSee('img/vegetales/' . $vegetal->imagen, false);
    }

    public function test_preparados_view_renders_image_tag(): void
    {
        $this->login();

        $prep = Preparado::create([
            'nombre' => 'Abono orgánico',
            'preparacion' => 'Mezcla de compost',
            'observaciones' => 'Aplicar semanal',
            'imagen' => '3_img.png',
        ]);

        $res = $this->get('/preparados');
        $res->assertStatus(200);
        $res->assertSee('<img', false);
        $res->assertSee('img/preparados/' . $prep->imagen, false);
    }

    public function test_finca_view_renders_image_tag(): void
    {
        $this->login();

        $finca = Finca::create([
            'nombre' => 'La Esperanza',
            'ubicacion' => 'Valle del Cauca',
            'propietario' => 'Juan Pérez',
            'imagen' => '4_img.png',
        ]);

        $res = $this->get('/finca');
        $res->assertStatus(200);
        $res->assertSee('<img', false);
        $res->assertSee('img/finca/' . $finca->imagen, false);
    }
}
