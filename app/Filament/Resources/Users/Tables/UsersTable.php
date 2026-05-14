<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;
use App\Models\Role;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('active_role')
                    ->label('Peran Aktif')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'siswa' => 'info',
                        'tutor' => 'success',
                        'orangtua' => 'warning',
                        'admin' => 'danger',
                        default => 'gray',
                    }),
                ToggleColumn::make('is_verified')
                    ->label('Terverifikasi')
                    ->getStateUsing(function ($record) {
                        $role = $record->roles()->where('name', 'tutor')->first();
                        return $role ? $role->pivot->is_verified : false;
                    })
                    ->updateStateUsing(function ($record, $state) {
                        $tutorRole = Role::where('name', 'tutor')->first();
                        if ($tutorRole) {
                            $record->roles()->updateExistingPivot($tutorRole->id, [
                                'is_verified' => $state,
                                'verified_at' => $state ? now() : null,
                            ]);
                        }
                    })
                    ->disabled(fn ($record) => $record->active_role !== 'tutor'),
                TextColumn::make('created_at')
                    ->label('Bergabung')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('active_role')
                    ->label('Filter Peran')
                    ->options([
                        'siswa' => 'Siswa',
                        'tutor' => 'Tutor',
                        'orangtua' => 'Orang Tua',
                    ]),
                TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make(),
                Action::make('lihat_ktp')
                    ->label('Lihat KTP')
                    ->icon('heroicon-o-identification')
                    ->color('info')
                    ->visible(fn ($record) => $record->active_role === 'tutor' && $record->roles()->where('name', 'tutor')->first()?->pivot->ktp_path)
                    ->url(fn ($record) => \Storage::url($record->roles()->where('name', 'tutor')->first()->pivot->ktp_path), true),
                Action::make('lihat_ijazah')
                    ->label('Lihat Ijazah')
                    ->icon('heroicon-o-academic-cap')
                    ->color('info')
                    ->visible(fn ($record) => $record->active_role === 'tutor' && $record->roles()->where('name', 'tutor')->first()?->pivot->ijazah_path)
                    ->url(fn ($record) => \Storage::url($record->roles()->where('name', 'tutor')->first()->pivot->ijazah_path), true),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
