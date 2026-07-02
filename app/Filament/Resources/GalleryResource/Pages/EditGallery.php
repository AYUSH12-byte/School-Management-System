<?php

namespace App\Filament\Resources\GalleryResource\Pages;

use App\Filament\Resources\GalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ListRecords;

class EditGallery extends EditRecord
{
    protected static string $resource = GalleryResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
}
