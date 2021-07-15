<div class="flex flex-col justify-center min-h-screen items-center text-center select-none">
    <x-vatsim-uk-logo class="w-72"></x-vatsim-uk-logo>
    <h1 class="mt-2 text-2xl bold font-bold text-uk-blue">Nexus</h1>
    <div class="mt-8">
        @if(!Auth::check())
        <button class="bg-uk-blue text-white rounded py-1 px-3" wire:click="login">
            Login
        </button>
        @else
        <p class="mb-2">Hello, <strong>{{Auth::user()->first_name}}</strong></p>
        <button class="bg-uk-blue text-white rounded py-1 px-3" wire:click="logout">
            Logout
        </button>
        @endif

        @if($errors->any())
        <p>
            @foreach($errors->all() as $error)
            <span class="text-red-500 text-sm font-semibold">{{$error}}</span>
            @endforeach
        </p>
        @endif
    </div>

</div>