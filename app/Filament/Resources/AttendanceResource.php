<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceResource\Pages;
use App\Filament\Resources\AttendanceResource\RelationManagers;
use App\Models\Attendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationLabel = 'Kehadiran';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function canViewAny(): bool
    {
    return auth()->user()->role === 'guru';
    }

    public static function form(Form $form): Form
{
    return $form->schema([
        Forms\Components\Select::make('assignment_id')
            ->label('Kelas & Mapel')
            ->relationship('assignment', 'id')
            ->required(),

        Forms\Components\Select::make('siswa_id')
            ->label('Siswa')
            ->relationship('siswa', 'name')
            ->required(),

        Forms\Components\DatePicker::make('date')
            ->label('Tanggal')
            ->required(),

        Forms\Components\Select::make('status')
            ->options([
                'Hadir' => 'Hadir',
                'Alpha' => 'Alpha',
                'Izin' => 'Izin',
                'Sakit' => 'Sakit',
            ])
            ->required(),

        Forms\Components\Hidden::make('recorded_by')
            ->default(fn () => auth()->id()),
    ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('siswa.name'),
            Tables\Columns\TextColumn::make('status'),
            Tables\Columns\TextColumn::make('date')->date(),
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
            'index' => Pages\ListAttendances::route('/'),
            'create' => Pages\CreateAttendance::route('/create'),
            'edit' => Pages\EditAttendance::route('/{record}/edit'),
        ];
    }
}
