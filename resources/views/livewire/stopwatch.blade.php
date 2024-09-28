<!-- resources/views/livewire/cronometro.blade.php -->
<div>
    <div class="flex justify-end items-center space-x-4">
        <button wire:click="$emit('startTimer')" class="btn btn-primary">Iniciar</button>
        <div id="timer" class="text-lg">
            {{ sprintf('%02d:%02d:%02d:%03d', $hours, $minutes, $seconds, $milliseconds) }}
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        let timer;
        window.addEventListener('start-timer', function () {
            let startTime = Date.now();
            timer = setInterval(function () {
                let elapsedTime = Date.now() - startTime;
                let milliseconds = elapsedTime % 1000;
                let seconds = Math.floor(elapsedTime / 1000) % 60;
                let minutes = Math.floor(elapsedTime / 60000) % 60;
                let hours = Math.floor(elapsedTime / 3600000);
                Livewire.emit('updateTimer', hours, minutes, seconds, milliseconds);
            }, 10);
        });
    });
</script>
