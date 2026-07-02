<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Course;
use App\Models\Student;
use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Actions;
use Filament\Tables;
use Filament\Tables\Table;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;
    public static function getNavigationIcon(): string|\BackedEnum|null { return 'heroicon-o-user-group'; }
    public static function getNavigationGroup(): ?string { return 'Academic'; }
    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Student Information')->schema([
                Forms\Components\FileUpload::make('image')
                    ->disk('public')->image()->directory('students')->avatar()->columnSpanFull(),
                Forms\Components\TextInput::make('name')->required()->maxLength(150),
                Forms\Components\TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('phone')->tel()->maxLength(20),
                Forms\Components\TextInput::make('roll_number')->unique(ignoreRecord: true),
                Forms\Components\Select::make('gender')
                    ->options(['male' => 'Male', 'female' => 'Female', 'other' => 'Other']),
                Forms\Components\DatePicker::make('dob')->label('Date of Birth'),
                Forms\Components\Textarea::make('address')->rows(2)->columnSpanFull(),
                Forms\Components\Select::make('course_id')
                    ->label('Course')
                    ->options(Course::pluck('title', 'id'))
                    ->searchable()->preload(),
                Forms\Components\Select::make('status')
                    ->options(['active' => 'Active', 'inactive' => 'Inactive', 'graduated' => 'Graduated'])
                    ->default('active'),
                Forms\Components\DatePicker::make('enrolled_at')->label('Enrollment Date'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->circular()->defaultImageUrl(asset('images/default-student.jpg')),
                Tables\Columns\TextColumn::make('roll_number')->label('Roll #')->searchable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('course.title')->badge()->color('info')->label('Course'),
                Tables\Columns\TextColumn::make('status')->badge()
                    ->color(fn($state) => match($state) {
                        'active' => 'success', 'graduated' => 'info', default => 'warning',
                    }),
                Tables\Columns\TextColumn::make('enrolled_at')->date()->sortable()->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('course_id')->label('Course')->options(Course::pluck('title', 'id')),
                Tables\Filters\SelectFilter::make('status')
                    ->options(['active' => 'Active', 'inactive' => 'Inactive', 'graduated' => 'Graduated']),
            ])
            ->actions([Actions\EditAction::make(), Actions\DeleteAction::make()])
            ->bulkActions([Actions\BulkActionGroup::make([Actions\DeleteBulkAction::make()])]);
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit'   => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
