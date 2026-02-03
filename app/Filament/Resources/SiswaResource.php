<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Filament\Resources\SiswaResource\RelationManagers;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function canViewAny(): bool
{
    return in_array(auth()->user()->role, ['admin', 'guru']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
        Forms\Components\TextInput::make('name')
            ->label('Nama Siswa')
            ->required(),

        Forms\Components\TextInput::make('nis')
            ->label('NIS')
            ->required(),

        Forms\Components\Select::make('kelas_id')
            ->label('Kelas')
            ->relationship('kelas', 'name')
            ->required(),

        Forms\Components\Select::make('wali_id')
            ->label('Wali Murid')
            ->relationship(
                'wali', 
                'name',
            fn ($query) => $query->where('role', 'wali_murid')
            )
            ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('nis'),
                Tables\Columns\TextColumn::make('kelas.name')->label('Kelas'),
                Tables\Columns\TextColumn::make('wali.name')->label('Wali Murid'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
