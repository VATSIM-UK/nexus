<div class="mb-4">
    <header class="flex flex-col mt-4">
        <div class="flex flex-col text-center md:text-left md:flex-row justify-between">
            <h1 class="text-white text-5xl font-medium ">Airfields</h1>
            <input type="text" wire:model="search" placeholder="Search by ICAO..." class="rounded mt-2 md:mt-0">
        </div>
        <div class="flex items-center justify-end mt-1">
            <input type="checkbox" class="rounded" wire:model="showEmpty">
            <p class="text-white ml-2">Show Empty Airfields</p>
        </div>
    </header>
    <main wire:loading.remove class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
        @foreach($airfields as $airfield)
            <div class="flex box-border flex-col bg-white rounded-lg shadow-lg p-8 hover:bg-uk-blue cursor-pointer">
                <h2 class="text-2xl font-medium">{{ $airfield['code'] }}</h2>
                <p>Stands: {{ $airfield['stands_count'] }}</p>
            </div>
        @endforeach
    </main> 
    <div wire:loading.flex class="text-white align-center text-3xl justify-center">Loading...</div>
</div>
