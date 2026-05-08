<?php

namespace App\Filament\Resources\StudyClasses\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StudyClassForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('student_id')
                    ->required()
                    ->numeric(),
                TextInput::make('tutor_id')
                    ->required()
                    ->numeric(),
                TextInput::make('subject_id')
                    ->required()
                    ->numeric(),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
                TextInput::make('metode_belajar')
                    ->default(null),
                TextInput::make('paket_mengajar')
                    ->default(null),
                TextInput::make('progress_percentage')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
