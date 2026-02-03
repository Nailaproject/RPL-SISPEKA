<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeachingAssignmentResource\Pages;
use App\Filament\Resources\TeachingAssignmentResource\RelationManagers;
use App\Models\TeachingAssignment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;


class TeachingAssignmentResource extends Resource
{
    protected static ?string $model = TeachingAssignment::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
        Forms\Components\Select::make('guru_id')
            ->label('Guru')
             ->relationship(
                    name: 'guru',
                    titleAttribute: 'name',
                    modifyQueryUsing: fn ($query) =>
                    $query->where('role', 'guru')
                )
                ->required(),

        Forms\Components\Select::make('kelas_id')
            ->label('Kelas')
            ->relationship('kelas', 'name')
            ->required(),

        Forms\Components\Select::make('subject_id')
            ->label('Mata Pelajaran')
            ->relationship('subject', 'name')
            ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('guru.name')
                ->label('Guru')
                ->searchable(),

            TextColumn::make('kelas.name')
                ->label('Kelas'),

            TextColumn::make('subject.name')
                ->label('Mata Pelajaran'),
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
            'index' => Pages\ListTeachingAssignments::route('/'),
            'create' => Pages\CreateTeachingAssignment::route('/create'),
            'edit' => Pages\EditTeachingAssignment::route('/{record}/edit'),
        ];
    }
}
