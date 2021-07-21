<?php

namespace App\Http\Livewire\Airfields;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\UKCP\AirfieldCollection;

class Index extends Component
{
    public string $search = '';

    protected $queryString = ['search' => ['except' => ''], 'showEmpty' => ['except' => false]];

    public bool $showEmpty = false;

    public function render()
    {
        $url = $this->showEmpty ? '/admin/airfields?all=true' : '/admin/airfields';
        $airfields = (new AirfieldCollection(Http::ukcp($url)['airfields']))->sortBy('code');

        // allow to search based upon a match of the
        $airfields_filtered = $this->search
            ? $airfields->search($this->search)
            : $airfields;

        return view('livewire.airfields.index', ['airfields' => $airfields_filtered]);
    }
}
