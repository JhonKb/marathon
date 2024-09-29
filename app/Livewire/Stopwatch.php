<?php

namespace App\Livewire;

use App\Models\Race;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Stopwatch extends Component
{
    public $hours = 0;
    public $minutes = 0;
    public $seconds = 0;
    public $milliseconds = 0;
    public $running = false;

    protected $listeners = ['startTimer' => 'start'];

    /**
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function render(): Application|Factory|View|\Illuminate\View\View
    {
        return view('livewire.stopwatch');
    }

    /**
     * @return void
     */
    public function start(): void
    {
        $this->running = true;
        $this->dispatchBrowserEvent('start-timer');

        $race = Race::find($this->raceId);
        $race->status = 'In Progress';
        $race->save();

        $this->emit('refreshList');
    }
}
