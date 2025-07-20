<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegistrationResource\Pages;
use App\Filament\Resources\RegistrationResource\RelationManagers;
use App\Models\Registration;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Laravolt\Indonesia\Facade as Indonesia;
use Filament\Tables\Columns\TextColumn;

class RegistrationResource extends Resource
{
    protected static ?string $model = Registration::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('id_product')->required()->unique(ignoreRecord: true),
            TextInput::make('name')->required(),
            TextInput::make('phone'),
            TextInput::make('email')->email(),

            Select::make('province_id')
                ->label('Provinsi')
                ->options(Indonesia::allProvinces()->pluck('name', 'id'))
                ->reactive()
                ->afterStateUpdated(fn($set) => $set('city_id', null))
                ->required(),

            Select::make('city_id')
                ->label('Kota/Kabupaten')
                ->options(
                    fn($get) =>
                    $get('province_id')
                        ? Indonesia::findProvince($get('province_id'), ['cities'])->cities->pluck('name', 'id')
                        : []
                )
                ->reactive()
                ->afterStateUpdated(fn($set) => $set('district_id', null))
                ->required(),

            Select::make('district_id')
                ->label('Kecamatan')
                ->options(
                    fn($get) =>
                    $get('city_id')
                        ? Indonesia::findCity($get('city_id'), ['districts'])->districts->pluck('name', 'id')
                        : []
                )
                ->reactive()
                ->afterStateUpdated(fn($set) => $set('village_id', null))
                ->required(),

            Select::make('village_id')
                ->label('Kelurahan/Desa')
                ->options(
                    fn($get) =>
                    $get('district_id')
                        ? Indonesia::findDistrict($get('district_id'), ['villages'])->villages->pluck('name', 'id')
                        : []
                )
                ->required(),

            Textarea::make('alamat_spesifik')
                ->label('Alamat Spesifik')
                ->rows(3),

            TextInput::make('koordinat'),
            TextInput::make('referral'),
            TextInput::make('status')->default('pending'),
        ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('province_id')
                    ->label('Provinsi')
                    ->formatStateUsing(fn($state) => Indonesia::findProvince($state)?->name),
                TextColumn::make('city_id')
                    ->label('Kota')
                    ->formatStateUsing(fn($state) => Indonesia::findCity($state)?->name),
                TextColumn::make('district_id')
                    ->label('Kecamatan')
                    ->formatStateUsing(fn($state) => Indonesia::findDistrict($state)?->name),
                TextColumn::make('village_id')
                    ->label('Kelurahan')
                    ->formatStateUsing(fn($state) => Indonesia::findVillage($state)?->name),
                TextColumn::make('status')->badge(),
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
            'index' => Pages\ListRegistrations::route('/'),
            'create' => Pages\CreateRegistration::route('/create'),
            'edit' => Pages\EditRegistration::route('/{record}/edit'),
        ];
    }
}
