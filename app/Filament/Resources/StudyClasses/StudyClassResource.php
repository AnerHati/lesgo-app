<?php

namespace App\Filament\Resources\StudyClasses;

use App\Filament\Resources\StudyClasses\Pages\CreateStudyClass;
use App\Filament\Resources\StudyClasses\Pages\EditStudyClass;
use App\Filament\Resources\StudyClasses\Pages\ListStudyClasses;
use App\Filament\Resources\StudyClasses\Schemas\StudyClassForm;
use App\Filament\Resources\StudyClasses\Tables\StudyClassesTable;
use App\Models\StudyClass;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudyClassResource extends Resource
{
    protected static ?string $model = StudyClass::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return StudyClassForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StudyClassesTable::configure($table);
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
            'index' => ListStudyClasses::route('/'),
            'create' => CreateStudyClass::route('/create'),
            'edit' => EditStudyClass::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
