<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Actions;
use Filament\Tables;
use Filament\Tables\Table;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;
    public static function getNavigationIcon(): string|\BackedEnum|null { return 'heroicon-o-photo'; }
    public static function getNavigationGroup(): ?string { return 'Content'; }
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make()->schema([
                Forms\Components\TextInput::make('title')->required()->maxLength(200)->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->image()
                    ->directory('gallery')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('category')->maxLength(100)->datalist(['Events', 'Sports', 'Academics', 'Campus', 'Others']),
                Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                Forms\Components\Textarea::make('description')->rows(2)->columnSpanFull(),
                Forms\Components\Toggle::make('is_active')->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('Image')->defaultImageUrl(asset('images/default-gallery.jpg')),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable()->limit(30),
                Tables\Columns\TextColumn::make('category')->searchable(),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->actions([Actions\EditAction::make(), Actions\DeleteAction::make()])
            ->reorderable('sort_order')
            ->bulkActions([Actions\BulkActionGroup::make([Actions\DeleteBulkAction::make()])]);
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListGallery::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit'   => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
