<x-filament-panels::page>
    <div>
        @livewire('stopwatch', ['raceId' => request('id')])
        @livewire('live-captures-list', ['raceId' => request('id')])
    </div>
</x-filament-panels::page>
