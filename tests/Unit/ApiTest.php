<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    public function test_get_job() {

        $id = 563;
        $response = $this->json('GET', "api/jobs/get/{$id}");
        $response->assertStatus(200);
            //->assertJson( $this );
    }

    public function test_create_job() {

        $data = [
            'submitter' => 1122
        ];
        
        $response = $this->json('POST', "api/jobs/create",$data);
        //var_dump($response['content']);
        $response->assertStatus(200);
    }

}
