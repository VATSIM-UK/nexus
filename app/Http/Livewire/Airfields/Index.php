<?php

namespace App\Http\Livewire\Airfields;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

// TODO: move to outside controller when need arises.
class Airfield
{
    public function __construct(array $airfield)
    {
        $this->code = $airfield['code'];
        $this->stands_count = $airfield['stands_count'];
    }
}

class Index extends Component
{
    public string $search = '';

    protected $queryString = ['search' => ['except' => ''], 'showEmpty' => ['except' => false]];

    public bool $showEmpty = false;

    public function render()
    {
        $url = $this->showEmpty ? '/admin/airfields?all=true' : '/admin/airfields';
        $airfields = collect(Http::ukcp($url)['airfields'])->mapInto(Airfield::class)->sortBy('code');

        // allow to search based upon a match of the
        $airfields_filtered = $this->search
            ? $airfields->filter(fn ($item) => preg_match("/{$this->search}/", $item->code) || stristr($item->code, $this->search))
            : $airfields;

        return view('livewire.airfields.index', ['airfields' => $airfields_filtered]);
    }
}
