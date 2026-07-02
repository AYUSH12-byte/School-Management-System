<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ListRecords;

class EditTeacher extends EditRecord
{
    protected static string $resource = TeacherResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
}
