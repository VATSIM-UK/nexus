<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_homepage_contains_the_livewire_component()
    {
        $this->get('/')
            ->assertSeeLivewire('landing-page')
            ->assertOk();
    }

    /** @test */
    public function the_landing_page_livewire_component_renders_correctly()
    {
        Livewire::test('landing-page')
            ->assertSee('Nexus')
            ->assertOk();
    }

    /** @test */
    public function the_landing_page_shows_login_button_when_logged_out()
    {
        Livewire::test('landing-page')
            ->assertSee('Login')
            ->call('login')
            ->assertRedirect('/auth/login');
    }

    /** @test */
    public function the_landing_page_shows_logout_button_and_user_name_when_logged_in()
    {
        $user = User::factory()->create([
            'first_name' => 'Joe'
        ]);
        $this->actingAs($user);

        Livewire::test('landing-page')
            ->assertSee('Logout')
            ->assertSeeText('Hello, Joe');

        Livewire::test('landing-page')
            ->call('logout');

        $this->assertFalse($this->isAuthenticated());
    }
}
