<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Livewire\Airfields\Index;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AirfieldsIndexTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void 
    {
        parent::setUp();

        Http::fake([
            '*/admin/airfields*' => Http::response([
                    'airfields' => [
                        [
                            'code' => 'EGLL',
                            'stands_count' => 1
                        ]
                    ]
                ], 200)
        ]);
    }
    /** @test */
    public function it_should_render_component_when_authenticated()
    {
        $this->actingAs(User::factory()->create())->get('/airfields')->assertSeeLivewire('airfields.index');
    }

    /** @test */
    public function it_should_call_api_without_query_param_when_not_showing_empty()
    {
        Livewire::withQueryParams(['showEmpty' => true])
            ->test(Index::class);

        Http::assertSent(function (Request $request) {
            return $request->url() == "ukcp.test/admin/airfields?all=true";       
        });
    }
}
