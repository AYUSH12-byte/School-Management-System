<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Actions;
use Filament\Tables;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;
    public static function getNavigationIcon(): string|\BackedEnum|null { return 'heroicon-o-envelope'; }
    public static function getNavigationGroup(): ?string { return 'Admissions'; }
    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'unread')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string { return 'danger'; }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make()->schema([
                Forms\Components\TextInput::make('name')->required()->disabled(),
                Forms\Components\TextInput::make('email')->email()->required()->disabled(),
                Forms\Components\TextInput::make('phone')->disabled(),
                Forms\Components\TextInput::make('subject')->required()->disabled()->columnSpanFull(),
                Forms\Components\Textarea::make('message')->rows(5)->disabled()->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->options(['unread' => 'Unread', 'read' => 'Read', 'replied' => 'Replied'])
                    ->default('unread'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('subject')->limit(40)->searchable(),
                Tables\Columns\TextColumn::make('status')->badge()
                    ->color(fn($state) => match($state) {
                        'replied' => 'success', 'read' => 'info', default => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')->label('Received')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['unread' => 'Unread', 'read' => 'Read', 'replied' => 'Replied']),
            ])
            ->actions([Actions\EditAction::make(), Actions\DeleteAction::make()])
            ->bulkActions([Actions\BulkActionGroup::make([Actions\DeleteBulkAction::make()])]);
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListContacts::route('/'),
            'edit'   => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
