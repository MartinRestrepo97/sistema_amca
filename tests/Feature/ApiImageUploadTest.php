<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ApiImageUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_animales_image_upload()
    {
        $file = UploadedFile::fake()->image('img4.png', 64, 64);

        $response = $this->post('/api/animales', [
            'especie' => 'Vaca',
            'raza' => 'Holstein',
            'alimentacion' => 'Pasto',
            'cuidados' => 'Vacunas',
            'reproduccion' => 'Natural',
            'observacion' => 'Sana',
            'imagen' => $file,
        ]);

        $response->assertCreated();
        $payload = $response->json();
        $this->assertNotEmpty($payload['imagen'] ?? null);
        $this->assertFileExists(public_path('img/animales/' . $payload['imagen']));
    }

    public function test_vegetales_image_upload()
    {
        $file = UploadedFile::fake()->image('img1.png', 64, 64);

        $response = $this->post('/api/vegetales', [
            'especie' => 'Tomate',
            'cultivo' => 'Invernadero',
            'observaciones' => 'Rojo',
            'imagen' => $file,
        ]);

        $response->assertCreated();
        $payload = $response->json();
        $this->assertNotEmpty($payload['imagen'] ?? null);
        $this->assertFileExists(public_path('img/vegetales/' . $payload['imagen']));
    }

    public function test_preparados_image_upload()
    {
        $file = UploadedFile::fake()->image('img2.png', 64, 64);

        $response = $this->post('/api/preparados', [
            'nombre' => 'Biol',
            'preparacion' => 'Fermentado',
            'observaciones' => 'OK',
            'imagen' => $file,
        ]);

        $response->assertCreated();
        $payload = $response->json();
        $this->assertNotEmpty($payload['imagen'] ?? null);
        $this->assertFileExists(public_path('img/preparados/' . $payload['imagen']));
    }

    public function test_fincas_image_upload()
    {
        $file = UploadedFile::fake()->image('img3.png', 64, 64);

        $response = $this->post('/api/fincas', [
            'nombre' => 'El Prado',
            'ubicacion' => 'Rionegro',
            'propietario' => 'Juan',
            'imagen' => $file,
        ]);

        $response->assertCreated();
        $payload = $response->json();
        $this->assertNotEmpty($payload['imagen'] ?? null);
        $this->assertFileExists(public_path('img/finca/' . $payload['imagen']));
    }
}
