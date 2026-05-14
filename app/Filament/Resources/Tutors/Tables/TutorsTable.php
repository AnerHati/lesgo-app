<?php

namespace App\Filament\Resources\Tutors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class TutorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_verified')
                    ->label('Verified')
                    ->boolean()
                    ->getStateUsing(fn ($record) => $record->roles()->where('name', 'tutor')->first()?->pivot->is_verified ?? false),
                TextColumn::make('tutorProfile.education')
                    ->label('Pendidikan')
                    ->searchable(),
                TextColumn::make('tutorProfile.rating')
                    ->label('Rating')
                    ->numeric(1)
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('verify')
                    ->label('Verifikasi')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => !($record->roles()->where('name', 'tutor')->first()?->pivot->is_verified ?? false))
                    ->action(function ($record) {
                        $role = $record->roles()->where('name', 'tutor')->first();
                        if ($role) {
                            $record->roles()->updateExistingPivot($role->id, [
                                'is_verified' => true,
                                'verified_at' => now(),
                            ]);
                        }
                    }),
                Action::make('view_ktp')
                    ->label('KTP')
                    ->icon('heroicon-o-identification')
                    ->color('info')
                    ->action(function ($record) {
                        $role = $record->roles()->where('name', 'tutor')->first();
                        $path = $role?->pivot->ktp_path;
                        if ($path && Storage::disk('private')->exists($path)) {
                            return response()->download(Storage::disk('private')->path($path));
                        }
                    })
                    ->visible(fn ($record) => !empty($record->roles()->where('name', 'tutor')->first()?->pivot->ktp_path)),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
