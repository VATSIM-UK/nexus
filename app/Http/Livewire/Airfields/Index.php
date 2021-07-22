<?php

namespace App\Http\Livewire\Airfields;

use App\Services\UKCP;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\UKCP\AirfieldCollection;

class Index extends Component
{
    public string $search = '';

    protected $queryString = ['search' => ['except' => ''], 'showEmpty' => ['except' => false]];

    public bool $showEmpty = false;

    public function render(UKCP $service)
    {
        $airfields = $service->getAirfields($this->showEmpty);

        return view('livewire.airfields.index', ['airfields' => $airfields->search($this->search)->sortBy('code')]);
    }
}
