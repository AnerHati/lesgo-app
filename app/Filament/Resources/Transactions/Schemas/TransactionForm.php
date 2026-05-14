<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Enums\TransactionStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('study_class_id')
                    ->relationship('studyClass', 'id')
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options(TransactionStatus::class)
                    ->default('pending')
                    ->required(),
                TextInput::make('payment_method')
                    ->default(null),
                TextInput::make('payment_proof')
                    ->default(null),
                DateTimePicker::make('paid_at'),
            ]);
    }
}
