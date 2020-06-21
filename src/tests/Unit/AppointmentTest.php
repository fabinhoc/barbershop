<?php

namespace Tests\Unit;

use App\User;
use App\Appointment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;

    protected $json = [
        'id',
        'serviceName', 
        'user_id', 
        'client_id',
        'dateExecution',
        'initialHour',
        'endHour',
        'isConfirmed'
    ];
   
    public function login()
    {
        $user = factory(User::class)->create()->toArray();
        
        $user['password'] = 'admin'; // admin password to test HASH::Check
        $response = $this->post('api/login', $user);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'email' => $user['email'],
        ]);

        $response->assertJsonStructure(['access_token', 'token_type', 'expires_in']);

        return (array) json_decode($response->content());
    }

    public function testCreate()
    {
        $auth = $this->login();
        
        $appointment = factory(Appointment::class)->make()->toArray();
        
        $response = $this->post('api/appointments', $appointment, ['Authorization' => 'Bearer ' . $auth['access_token']]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('appointments', [
            'serviceName' => $appointment['serviceName'],
        ]);

        return (array) json_decode($response->content());
    }

    public function testUpdate()
    {
        $auth = $this->login();

        $appointment = $this->testCreate();

        $response = $this->put('api/appointments/' . $appointment['id'], ['name' => 'Fabio Cruz'], ['Authorization' => 'Bearer ' . $auth['access_token']]);
        $this->assertDatabaseHas('appointments', [
            'serviceName' => $appointment['serviceName'],
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure($this->json);
    }

    public function testList()
    {
        $auth = $this->login();

        $response = $this->get('api/appointments', ['Authorization' => 'Bearer ' . $auth['access_token']]);
        $response->assertStatus(200);
    }

    public function testShow()
    {
        $auth = $this->login();
        
        $appointment = $this->testCreate();

        $response = $this->get('api/appointments/' . $appointment['id'], ['Authorization' => 'Bearer ' . $auth['access_token']]);
        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $auth = $this->login();

        $appointment = $this->testCreate();

        $this->delete('api/appointments/' . $appointment['id'], [], ['Authorization' => $auth['access_token']]);
    }
}
