<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Stopwatch extends Component
{
    public $milliseconds = 0;
    public $seconds = 0;
    public $minutes = 0;
    public $hours = 0;
    public $running = false;
    public $started = false;
    protected $timer;

    /**
     * @return void
     */
    public function startTimer(): void
    {
        $this->running = true;
        $this->started = true;
        $this->updateTimer();
    }

    /**
     * @return void
     */
    public function stopTimer(): void
    {
        $this->running = false;
    }

    /**
     * @return void
     */
    public function resetTimer(): void
    {
        $this->running = false;
        $this->started = false;
        $this->milliseconds = 0;
        $this->seconds = 0;
        $this->minutes = 0;
        $this->hours = 0;
    }

    /**
     * @return void
     */
    public function updateTimer(): void
    {
        if ($this->running) {
            $this->milliseconds += 1;

            if ($this->milliseconds == 100) {
                $this->milliseconds = 0;
                $this->seconds++;
            }

            if ($this->seconds == 60) {
                $this->seconds = 0;
                $this->minutes++;
            }

            if ($this->minutes == 60) {
                $this->minutes = 0;
                $this->hours++;
            }
        }
    }

    /**
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function render(): Application|Factory|View|\Illuminate\View\View
    {
        return view('livewire.stopwatch');
    }
}
