<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ListRecords;

class EditNews extends EditRecord
{
    protected static string $resource = NewsResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
}
