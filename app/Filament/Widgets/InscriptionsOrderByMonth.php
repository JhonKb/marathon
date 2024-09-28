<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class InscriptionsOrderByMonth extends ChartWidget
{
    protected static ?string $heading = 'Inscriptions Per Month';
    protected int | string | array $columnSpan = 'full';
    protected static ?string $maxHeight = '400px';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Months',
                    'data' => [0, 10, 5, 11, 4, 5, 6, 10, 1, 3, 5, 2],
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
