<?php

use Livewire\Livewire;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
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
}
