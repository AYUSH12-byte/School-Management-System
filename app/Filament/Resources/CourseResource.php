<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Models\Course;
use App\Models\Department;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Actions;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;
    public static function getNavigationIcon(): string|\BackedEnum|null { return 'heroicon-o-book-open'; }
    public static function getNavigationGroup(): ?string { return 'Academic'; }
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Course Information')->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(200)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn($state, Set $set) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\Select::make('department_id')
                    ->label('Department')
                    ->options(Department::pluck('name', 'id'))
                    ->searchable()->preload(),
                Forms\Components\Select::make('teacher_id')
                    ->label('Instructor')
                    ->options(Teacher::pluck('name', 'id'))
                    ->searchable()->preload(),
                Forms\Components\Select::make('level')
                    ->options(['beginner' => 'Beginner', 'intermediate' => 'Intermediate', 'advanced' => 'Advanced'])
                    ->required()
                    ->default('beginner'),
                Forms\Components\TextInput::make('duration')->placeholder('e.g. 6 months'),
                Forms\Components\TextInput::make('fee')->numeric()->prefix('NPR')->default(0),
                Forms\Components\TextInput::make('seats')->numeric()->default(30),
                Forms\Components\Textarea::make('description')->rows(3)->columnSpanFull(),
                Forms\Components\RichEditor::make('content')->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->disk('public')->image()->directory('courses')->columnSpanFull(),
                Forms\Components\Toggle::make('is_active')->default(true)->inline(false),
                Forms\Components\Toggle::make('is_featured')->default(false)->inline(false),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->defaultImageUrl(asset('images/default-course.jpg')),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable()->limit(30),
                Tables\Columns\TextColumn::make('department.name')->badge()->color('info'),
                Tables\Columns\TextColumn::make('teacher.name')->label('Instructor')->toggleable(),
                Tables\Columns\TextColumn::make('level')->badge()
                    ->color(fn($state) => match($state) {
                        'beginner' => 'success',
                        'intermediate' => 'warning',
                        'advanced' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('fee')->money('NPR')->sortable(),
                Tables\Columns\TextColumn::make('students_count')->counts('students')->badge()->color('gray')->label('Students'),
                Tables\Columns\IconColumn::make('is_featured')->boolean()->label('Featured'),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Active'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('department_id')->label('Department')->options(Department::pluck('name', 'id')),
                Tables\Filters\SelectFilter::make('level')->options(['beginner' => 'Beginner', 'intermediate' => 'Intermediate', 'advanced' => 'Advanced']),
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->actions([Actions\EditAction::make(), Actions\DeleteAction::make()])
            ->bulkActions([Actions\BulkActionGroup::make([Actions\DeleteBulkAction::make()])]);
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit'   => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
