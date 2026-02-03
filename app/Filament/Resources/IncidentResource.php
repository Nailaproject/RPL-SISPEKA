<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IncidentResource\Pages;
use App\Filament\Resources\IncidentResource\RelationManagers;
use App\Models\Incident;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IncidentResource extends Resource
{
    protected static ?string $model = Incident::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-triangle';

   public static function form(Form $form): Form
{
    return $form->schema([
        Forms\Components\Select::make('siswa_id')
            ->relationship('siswa','name')
            ->required(),

        Forms\Components\Select::make('severity')
            ->options([
                'Ringan'=>'Ringan',
                'Sedang'=>'Sedang',
                'Berat'=>'Berat',
            ])
            ->required(),

        Forms\Components\Textarea::make('description')
            ->required(),

        Forms\Components\Hidden::make('status')
            ->default('Reported'),

        Forms\Components\Hidden::make('reported_by_id')
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

            Tables\Columns\TextColumn::make('severity')
                ->label('Tingkat')
                ->badge(),

            Tables\Columns\TextColumn::make('status')
                ->label('Status')
                ->badge(),

            Tables\Columns\TextColumn::make('reportedBy.name')
                ->label('Dilaporkan Oleh'),

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
            'index' => Pages\ListIncidents::route('/'),
            'create' => Pages\CreateIncident::route('/create'),
            'edit' => Pages\EditIncident::route('/{record}/edit'),
        ];
    }
}
