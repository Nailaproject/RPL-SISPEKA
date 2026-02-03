<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GradeResource\Pages;
use App\Filament\Resources\GradeResource\RelationManagers;
use App\Models\Grade;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GradeResource extends Resource
{
    protected static ?string $model = Grade::class;

    protected static ?string $navigationLabel = 'Nilai';

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function canViewAny(): bool
    {
    return auth()->user()->role === 'guru';
    }

   public static function form(Form $form): Form
{
    return $form->schema([
        Forms\Components\Select::make('siswa_id')
            ->relationship('siswa','name')
            ->required(),

        Forms\Components\Select::make('assignment_id')
            ->relationship('assignment','id')
            ->required(),

        Forms\Components\TextInput::make('type')
            ->label('Jenis Nilai')
            ->required(),

        Forms\Components\TextInput::make('score')
            ->numeric()
            ->required(),

        Forms\Components\Hidden::make('recorded_by')
            ->default(fn()=>auth()->id()),
    ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('siswa.name')
                ->label('Siswa')
                ->searchable(),

            Tables\Columns\TextColumn::make('assignment.subject.name')
                ->label('Mapel'),

            Tables\Columns\TextColumn::make('type')
                ->label('Jenis Nilai'),

            Tables\Columns\TextColumn::make('score')
                ->label('Nilai'),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Tanggal')
                ->date(),
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
            'index' => Pages\ListGrades::route('/'),
            'create' => Pages\CreateGrade::route('/create'),
            'edit' => Pages\EditGrade::route('/{record}/edit'),
        ];
    }
}
