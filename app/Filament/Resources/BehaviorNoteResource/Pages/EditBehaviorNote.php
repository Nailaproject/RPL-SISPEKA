<?php

namespace App\Filament\Resources\BehaviorNoteResource\Pages;

use App\Filament\Resources\BehaviorNoteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBehaviorNote extends EditRecord
{
    protected static string $resource = BehaviorNoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
