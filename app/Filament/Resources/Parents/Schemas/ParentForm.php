<?php

namespace App\Filament\Resources\Parents\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ParentForm
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
                Section::make('Profil Orang Tua')
                    ->relationship('parentProfile')
                    ->schema([
                        TextInput::make('occupation')
                            ->label('Pekerjaan'),
                        TextInput::make('emergency_contact')
                            ->label('Kontak Darurat'),
                    ])->columns(2),
            ]);
    }
}
