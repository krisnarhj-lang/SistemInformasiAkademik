<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SisfoTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_can_be_accessed(): void
    {
        $this->seed();

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Akademik');
    }

    public function test_login_page_can_be_accessed(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Selamat Datang Kembali!');
    }

    public function test_user_can_login(): void
    {
        $this->seed();

        $response = $this->post('/login', [
            'email' => 'admin@admin.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }
}
