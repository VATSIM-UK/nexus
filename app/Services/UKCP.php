<?php

namespace App\Services;

use App\Http\Resources\UKCP\AirfieldCollection;
use Illuminate\Support\Facades\Http;

/**
 * Class holding common API interactions with the UK Controller Plugin API.
 */
class UKCP
{
    private $client;
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.vatsim_uk_controller_api.base_url');
        $this->client = Http::withToken(config('services.vatsim_uk_controller_api.token'));
    }

    public function getAirfields($all = false): AirfieldCollection
    {
        $url = $all ? '/admin/airfields?all=true' : '/admin/airfields';

        return new AirfieldCollection($this->client->get($this->baseUrl.$url)['airfields']);
    }
}
