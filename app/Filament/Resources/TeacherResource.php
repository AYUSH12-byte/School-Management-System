<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Models\Department;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Actions;
use Filament\Tables;
use Filament\Tables\Table;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;
    public static function getNavigationIcon(): string|\BackedEnum|null { return 'heroicon-o-academic-cap'; }
    public static function getNavigationGroup(): ?string { return 'Academic'; }
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Personal Information')->schema([
                Forms\Components\FileUpload::make('image')
                    ->disk('public')
                    ->image()
                    ->directory('teachers')
                    ->avatar()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('name')->required()->maxLength(150),
                Forms\Components\TextInput::make('email')->email()->required()->unique(ignoreRecord: true)->maxLength(200),
                Forms\Components\TextInput::make('phone')->tel()->maxLength(20),
                Forms\Components\Select::make('department_id')
                    ->label('Department')
                    ->options(Department::pluck('name', 'id'))
                    ->searchable()->preload(),
                Forms\Components\TextInput::make('designation')->maxLength(100),
                Forms\Components\DatePicker::make('joining_date'),
                Forms\Components\TextInput::make('experience_years')->numeric()->label('Experience (Years)')->default(0),
                Forms\Components\Textarea::make('bio')->rows(3)->columnSpanFull(),
                Forms\Components\Toggle::make('is_active')->default(true)->inline(false),
            ])->columns(2),
            
            Section::make('Social Links')->schema([
                Forms\Components\TextInput::make('facebook_url')->url()->maxLength(250),
                Forms\Components\TextInput::make('twitter_url')->url()->maxLength(250),
                Forms\Components\TextInput::make('linkedin_url')->url()->maxLength(250),
            ])->columns(3)->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->circular()->defaultImageUrl(asset('images/default-teacher.jpg')),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('department.name')->badge()->color('info'),
                Tables\Columns\TextColumn::make('designation')->toggleable(),
                Tables\Columns\TextColumn::make('experience_years')->label('Experience')->numeric()->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Active'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('department_id')->label('Department')->options(Department::pluck('name', 'id')),
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->actions([Actions\EditAction::make(), Actions\DeleteAction::make()])
            ->bulkActions([Actions\BulkActionGroup::make([Actions\DeleteBulkAction::make()])]);
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit'   => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}
