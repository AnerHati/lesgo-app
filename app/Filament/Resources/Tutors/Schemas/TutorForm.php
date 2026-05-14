<?php

namespace App\Filament\Resources\Tutors\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TutorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Dasar')
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->email()
                            ->required(),
                        TextInput::make('phone'),
                    ])->columns(2),
                Section::make('Profil Tutor')
                    ->relationship('tutorProfile')
                    ->schema([
                        TextInput::make('education')
                            ->label('Pendidikan Terakhir'),
                        TextInput::make('experience_years')
                            ->label('Pengalaman (Tahun)')
                            ->numeric(),
                        TextInput::make('hourly_rate')
                            ->label('Tarif per Jam')
                            ->numeric()
                            ->prefix('Rp'),
                        Textarea::make('bio')
                            ->columnSpanFull(),
                        Textarea::make('teaching_method')
                            ->label('Metode Mengajar')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
