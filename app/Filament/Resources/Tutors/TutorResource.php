<?php

namespace App\Filament\Resources\Tutors;

use App\Filament\Resources\Tutors\Pages\CreateTutor;
use App\Filament\Resources\Tutors\Pages\EditTutor;
use App\Filament\Resources\Tutors\Pages\ListTutors;
use App\Filament\Resources\Tutors\Pages\ViewTutor;
use App\Filament\Resources\Tutors\Schemas\TutorForm;
use App\Filament\Resources\Tutors\Schemas\TutorInfolist;
use App\Filament\Resources\Tutors\Tables\TutorsTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TutorResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string | \BackedEnum | null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static ?string $navigationLabel = 'Tutor';

    protected static ?string $pluralLabel = 'Tutor';

    protected static string | \UnitEnum | null $navigationGroup = 'Manajemen Pengguna';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return TutorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TutorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TutorsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('roles', fn ($query) => $query->where('name', 'tutor'))
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTutors::route('/'),
            'create' => CreateTutor::route('/create'),
            'view' => ViewTutor::route('/{record}'),
            'edit' => EditTutor::route('/{record}/edit'),
        ];
    }
}
