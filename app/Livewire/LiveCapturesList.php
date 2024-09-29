<?php

namespace App\Livewire;

use App\Models\Inscription;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Component;

class LiveCapturesList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    /**
     * @var
     */
    public $raceId;

    /**
     * @var string[]
     */
    protected $listeners = ['refreshList' => '$refresh'];

    /**
     * @param $raceId
     * @return void
     */
    public function mount($raceId): void
    {
        $this->raceId = $raceId;
    }

    /**
     * @return Application|Factory|View
     */
    public function render(): Application|Factory|View
    {
        return view('livewire.live-captures-list');
    }

    /**
     * @param Table $table
     * @return Table
     */
    public function table(Table $table): Table
    {
        return $table
            ->query(Inscription::query()->where('race_id', $this->raceId))
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('last_lap')->getStateUsing(fn($record) => $record->getLastLapCaptured())
                    ->alignCenter(),
                TextColumn::make('last_checkpoint')->getStateUsing(fn($record) => $record->getLastCheckpointCaptured())
                    ->alignCenter(),
                TextColumn::make('total_time')->getStateUsing(fn($record) => $record->calculateTotalTime())->time('H:i:s.u')
                    ->alignCenter(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }
}
