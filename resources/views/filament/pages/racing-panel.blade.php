@php
    $races = $this->getRaces()
@endphp
<x-filament::page>
    <div class="grid grid-cols-2 sm:grid-cols-1 md:grid-cols-3 gap-8">
        @foreach ($races as $race)
            <x-filament::card class="flex flex-col p-4 min-w-min">
                <h2 class="text-2xl italic font-bold mb-5">{{ $race->name }}</h2>
                <div class="flex flex-row justify-between my-10">
                    <div class="text-center">
                        <strong>Date</strong>
                        <div>{{ date_format(new DateTime($race->date_time), 'd/m/y') }}</div>
                    </div>
                    <div class="text-center">
                        <strong>Time</strong>
                        <div>{{ date_format(new DateTime($race->date_time), 'H:i') }}</div>
                    </div>
                    <div class="text-center">
                        <strong>Distance</strong>
                        <div>{{ $race->total_distance_km }} km</div>
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <x-filament::button tag="a" href="{{ route('filament.admin.pages.start-race', ['id'=> $race->id]) }}">
                        Start Race
                    </x-filament::button>
                </div>
            </x-filament::card>
        @endforeach
    </div>
</x-filament::page>


