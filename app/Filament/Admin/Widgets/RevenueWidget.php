<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use App\Models\Transaction;

class RevenueWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalPaidAmount = Transaction::where('status', 'paid')->sum('amount');
        $lesgoCommission = $totalPaidAmount * 0.1;

        return [
            Stat::make('Total Pemasukan Platform (10%)', 'IDR ' . number_format($lesgoCommission, 0, ',', '.'))
                ->description('Total komisi dari seluruh transaksi yang berstatus paid')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Total Transaksi Berhasil', Transaction::where('status', 'paid')->count())
                ->description('Jumlah kelas yang telah dibayar')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('info'),
        ];
    }
}
