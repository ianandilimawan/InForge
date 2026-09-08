<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UiKitTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $role = Role::create(['name' => 'super-admin']);
        $this->admin = User::factory()->create();
        $this->admin->assignRole($role);
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get(route('admin.uikit'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_view_uikit_showcase(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.uikit'));

        $response->assertStatus(200);
        $response->assertSee('UI Components Showcase');
        $response->assertSee('Buttons');
        $response->assertSee('Badges');
    }
}
