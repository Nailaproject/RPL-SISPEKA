<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BehaviorNoteResource\Pages;
use App\Filament\Resources\BehaviorNoteResource\RelationManagers;
use App\Models\BehaviorNote;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BehaviorNoteResource extends Resource
{
    protected static ?string $model = BehaviorNote::class;

    protected static ?string $navigationLabel = 'Catatan Prilaku';

    protected static ?string $navigationIcon = 'heroicon-o-face-smile';

   public static function form(Form $form): Form
{
    return $form->schema([
        Forms\Components\Select::make('siswa_id')
            ->relationship('siswa','name')
            ->required(),

        Forms\Components\Select::make('category')
            ->options([
                'Positif'=>'Positif',
                'Negatif'=>'Negatif',
                'Pembinaan'=>'Pembinaan',
            ])
            ->required(),

        Forms\Components\Textarea::make('description')
            ->label('Catatan')
            ->required(),

        Forms\Components\TextInput::make('action_taken')
            ->label('Tindakan'),

        Forms\Components\Hidden::make('guru_id')
            ->default(fn()=>auth()->id()),

        Forms\Components\Hidden::make('date')
            ->default(now()),
    ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('siswa.name')
                ->label('Siswa')
                ->searchable(),

            Tables\Columns\TextColumn::make('category')
                ->label('Kategori')
                ->badge(),

            Tables\Columns\TextColumn::make('description')
                ->label('Catatan')
                ->limit(40),

            Tables\Columns\TextColumn::make('guru.name')
                ->label('Guru'),

            Tables\Columns\TextColumn::make('date')
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
            'index' => Pages\ListBehaviorNotes::route('/'),
            'create' => Pages\CreateBehaviorNote::route('/create'),
            'edit' => Pages\EditBehaviorNote::route('/{record}/edit'),
        ];
    }
}
