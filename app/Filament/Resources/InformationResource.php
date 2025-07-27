<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InformationResource\Pages;
use App\Filament\Resources\InformationResource\RelationManagers;
use App\Models\Information;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InformationResource extends Resource
{
    protected static ?string $model = Information::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\TextInput::make('sub_title'),
            Forms\Components\FileUpload::make('image')->directory('informations')->image(),
            Forms\Components\TextInput::make('slug')->unique(ignoreRecord: true)->required(),

            Forms\Components\Select::make('category_information_id')
                ->relationship('category', 'title')
                ->label('Kategori')
                ->required(),

            Forms\Components\RichEditor::make('content')->label('Konten')->required(),
            Forms\Components\Textarea::make('meta_keywords')->label('Meta Keywords'),

            Forms\Components\Toggle::make('status')
                ->label('Aktif')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('category.title')->label('Kategori'),
            Tables\Columns\IconColumn::make('status')
                ->boolean()
                ->label('Status'),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
        ]);
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInformation::route('/'),
            'create' => Pages\CreateInformation::route('/create'),
            'edit' => Pages\EditInformation::route('/{record}/edit'),
        ];
    }
}
