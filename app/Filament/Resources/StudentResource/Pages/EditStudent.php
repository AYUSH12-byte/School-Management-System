<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ListRecords;

class EditStudent extends EditRecord
{
    protected static string $resource = StudentResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
}
