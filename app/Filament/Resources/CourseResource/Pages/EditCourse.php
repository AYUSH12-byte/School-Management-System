<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ListRecords;

class EditCourse extends EditRecord
{
    protected static string $resource = CourseResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
}
