<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class StudentForm
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
                Section::make('Profil Siswa')
                    ->relationship('studentProfile')
                    ->schema([
                        TextInput::make('grade_level')
                            ->label('Tingkat Pendidikan'),
                        TextInput::make('school_name')
                            ->label('Nama Sekolah'),
                        Textarea::make('bio')
                            ->columnSpanFull(),
                        Textarea::make('learning_goals')
                            ->label('Tujuan Belajar')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
