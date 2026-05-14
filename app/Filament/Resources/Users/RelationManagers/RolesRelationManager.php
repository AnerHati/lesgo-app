<?php

namespace App\Filament\Resources\Users\RelationManagers;

use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Storage;

class RolesRelationManager extends RelationManager
{
    protected static string $relationship = 'roles';
    protected static ?string $title = 'Peran & Verifikasi Berkas';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('display_name')->label('Peran'),
                IconColumn::make('is_verified')
                    ->label('Terverifikasi?')
                    ->boolean()
                    ->getStateUsing(fn ($record) => $record->pivot->is_verified ?? false),
                TextColumn::make('registration_step')
                    ->label('Langkah Registrasi')
                    ->getStateUsing(fn ($record) => $record->pivot->registration_step ?? 1),
            ])
            ->filters([
                //
            ])
            ->headerActions([
            ])
            ->recordActions([
                Action::make('download_ktp')
                    ->label('KTP')
                    ->icon('heroicon-o-identification')
                    ->color('info')
                    ->visible(fn ($record) => !empty($record->pivot->ktp_path))
                    ->action(function ($record) {
                        $path = $record->pivot->ktp_path;
                        if (Storage::disk('private')->exists($path)) {
                            return response()->download(Storage::disk('private')->path($path));
                        }
                    }),
                Action::make('download_ijazah')
                    ->label('Ijazah')
                    ->icon('heroicon-o-academic-cap')
                    ->color('warning')
                    ->visible(fn ($record) => !empty($record->pivot->ijazah_path))
                    ->action(function ($record) {
                        $path = $record->pivot->ijazah_path;
                        if (Storage::disk('private')->exists($path)) {
                            return response()->download(Storage::disk('private')->path($path));
                        }
                    }),
                Action::make('verify')
                    ->label('Verifikasi')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Verifikasi Peran')
                    ->modalDescription('Apakah Anda yakin dokumen pengguna ini sudah valid dan peran ini dapat disetujui?')
                    ->visible(fn ($record) => !($record->pivot->is_verified ?? false))
                    ->action(function ($record, $livewire) {
                        $livewire->getOwnerRecord()->roles()->updateExistingPivot($record->id, ['is_verified' => true]);
                    }),
            ])
            ->toolbarActions([
            ]);
    }
}
