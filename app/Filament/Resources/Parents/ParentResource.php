<?php

namespace App\Filament\Resources\Parents;

use App\Filament\Resources\Parents\Pages\CreateParent;
use App\Filament\Resources\Parents\Pages\EditParent;
use App\Filament\Resources\Parents\Pages\ListParents;
use App\Filament\Resources\Parents\Pages\ViewParent;
use App\Filament\Resources\Parents\Schemas\ParentForm;
use App\Filament\Resources\Parents\Schemas\ParentInfolist;
use App\Filament\Resources\Parents\Tables\ParentsTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParentResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string | \BackedEnum | null $navigationIcon = Heroicon::OutlinedHomeModern;

    protected static ?string $navigationLabel = 'Orang Tua';

    protected static ?string $pluralLabel = 'Orang Tua';

    protected static string | \UnitEnum | null $navigationGroup = 'Manajemen Pengguna';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ParentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ParentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ParentsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('roles', fn ($query) => $query->where('name', 'orangtua'))
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
            'index' => ListParents::route('/'),
            'create' => CreateParent::route('/create'),
            'view' => ViewParent::route('/{record}'),
            'edit' => EditParent::route('/{record}/edit'),
        ];
    }
}

