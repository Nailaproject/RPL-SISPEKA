<?php

namespace App\Filament\Resources\BehaviorNoteResource\Pages;

use App\Filament\Resources\BehaviorNoteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBehaviorNotes extends ListRecords
{
    protected static string $resource = BehaviorNoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
