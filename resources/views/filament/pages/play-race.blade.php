<x-filament-panels::page>
    <div class="container mx-auto">
        @livewire('stopwatch', ['raceId' => request('id')])
        @livewire('live-captures-list', ['raceId' => request('id')])
    </div>
</x-filament-panels::page>
