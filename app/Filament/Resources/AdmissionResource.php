<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdmissionResource\Pages;
use App\Models\Admission;
use App\Models\Course;
use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Actions;
use Filament\Tables;
use Filament\Tables\Table;

class AdmissionResource extends Resource
{
    protected static ?string $model = Admission::class;
    public static function getNavigationIcon(): string|\BackedEnum|null { return 'heroicon-o-clipboard-document-list'; }
    public static function getNavigationGroup(): ?string { return 'Admissions'; }
    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string { return 'warning'; }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Applicant Details')->schema([
                Forms\Components\TextInput::make('name')->required()->maxLength(150),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('phone')->required()->maxLength(20),
                Forms\Components\Select::make('gender')->options(['male' => 'Male', 'female' => 'Female', 'other' => 'Other']),
                Forms\Components\DatePicker::make('dob'),
                Forms\Components\TextInput::make('address')->maxLength(250),
                Forms\Components\Select::make('course_id')
                    ->label('Applied Course')
                    ->options(Course::pluck('title', 'id'))
                    ->required()->searchable()->preload(),
                Forms\Components\TextInput::make('previous_school')->maxLength(200),
                Forms\Components\TextInput::make('qualification')->maxLength(150),
                Forms\Components\Textarea::make('message')->rows(3)->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'])
                    ->default('pending'),
                Forms\Components\DateTimePicker::make('reviewed_at'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('course.title')->badge()->color('info')->label('Course'),
                Tables\Columns\TextColumn::make('status')->badge()
                    ->color(fn($state) => match($state) {
                        'approved' => 'success', 'rejected' => 'danger', default => 'warning',
                    }),
                Tables\Columns\TextColumn::make('created_at')->label('Applied')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected']),
                Tables\Filters\SelectFilter::make('course_id')->label('Course')->options(Course::pluck('title', 'id')),
            ])
            ->actions([Actions\EditAction::make(), Actions\DeleteAction::make()])
            ->bulkActions([Actions\BulkActionGroup::make([Actions\DeleteBulkAction::make()])]);
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAdmissions::route('/'),
            'create' => Pages\CreateAdmission::route('/create'),
            'edit'   => Pages\EditAdmission::route('/{record}/edit'),
        ];
    }
}
