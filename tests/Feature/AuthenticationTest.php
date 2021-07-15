<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_gets_redirected_for_sso_login()
    {
        dd(config('services.vatsim_uk_core'));
        $response = $this->get('/auth/login');

        $response->assertRedirect();

        $encodedCallbackUrl = urlencode(route('auth.login.callback'));
        $this->assertStringStartsWith("http://vatsimukcore.example/oauth/authorize?client_id=1&redirect_uri={$encodedCallbackUrl}", $response->getTargetUrl());
    }

    /** @test */
    public function it_handles_sso_callback_when_whitelisted()
    {
        $socialiteUser = new User();
        $socialiteUser->id = 1300001;
        $socialiteUser->email = 'fakeemail@example.org';
        $socialiteUser->first_name = 'Joe';
        $socialiteUser->last_name = 'Bloggs';

        Socialite::shouldReceive('driver->user')->andReturn($socialiteUser);
        $response = $this->get('/auth/login/callback');

        $response->assertRedirect();
        $this->assertAuthenticated();
    }

    /** @test */
    public function it_handles_rejects_user_if_not_whitelisted()
    {
        $socialiteUser = new User();
        $socialiteUser->id = 10000001;
        $socialiteUser->email = 'fakeemail@example.org';
        $socialiteUser->first_name = 'Joe';
        $socialiteUser->last_name = 'Bloggs';

        Socialite::shouldReceive('driver->user')->andReturn($socialiteUser);
        $response = $this->get('/auth/login/callback');

        $response->assertRedirect('/')->assertSessionHasErrors();
    }
}
