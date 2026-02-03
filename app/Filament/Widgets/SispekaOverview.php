<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;

class SispekaOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Siswa', Siswa::count())
                ->icon('heroicon-o-user-group')
                ->color('primary'),

            Stat::make('Total Kelas', Kelas::count())
                ->icon('heroicon-o-building-library')
                ->color('success'),

            Stat::make('Total Guru', User::where('role', 'guru')->count())
                ->icon('heroicon-o-academic-cap')
                ->color('warning'),

            Stat::make(
                'Kehadiran Hari Ini',
                Stat::make('Total Kehadiran', Attendance::count())

            )
                ->icon('heroicon-o-check-circle')
                ->color('info'),
        ];
    }
}
