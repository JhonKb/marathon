<div>
    <div class="flex justify-between items-center pb-6">
        <div class="space-x-4">
            <x-filament::button wire:click="{{ $this->running ? 'stopTimer' : 'startTimer' }}"
                                color="{{ $this->running ? 'gray' : 'primary' }}" class="w-32 h-10 m"
                                icon="{{ $this->running ? 'heroicon-s-pause' : 'heroicon-s-play' }}">{{ $this->running ? 'Pause' : 'Start' }}
            </x-filament::button>
            @if($this->started)
                <x-filament::button wire:click="resetTimer" class="w-32 h-10 mx-3" icon="heroicon-s-stop">
                    Reset
                </x-filament::button>
            @endif
        </div>
        <h1 class="text-3xl w-72 text-justify">{{ sprintf('%02d : %02d : %02d : %02d', $hours, $minutes, $seconds, $milliseconds) }}</h1>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', function () {
        setInterval(() => {
            @this.
            call('updateTimer');
        }, 10);
    });
</script>

