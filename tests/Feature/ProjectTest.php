<?php

namespace Tests\Feature;

use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    public function test_index_view_request()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_database_connection()
    {
        $this->withoutExceptionHandling();

        try {
            DB::connection()->getPdo();
            $connection = true;
        } catch (Exception $e) {
            $connection = false;
        }
        $this->assertTrue($connection);
    }

    public function test_get_data_from_database()
    {
        $this->withoutExceptionHandling();

        $response = $this->json('GET', 'api/calls');

        $response->assertStatus(200);

    }
    public function test_get_data_from_database_return_with_a_valid_format()
    {
        $this->withoutExceptionHandling();

        $response = $this->json('GET', 'api/calls');

        $response->assertJsonStructure(
            [
                'data' => [
                    '*' => [
                        'centro',
                        'nombre',
                        'municipio',
                        'NerLDNE',
                        'NerLDIE',
                    ]
                ]
            ]
        );
    }
}
