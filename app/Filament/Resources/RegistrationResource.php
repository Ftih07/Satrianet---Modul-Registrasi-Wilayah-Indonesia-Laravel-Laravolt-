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
            // Pilih Produk
            Forms\Components\Select::make('product_id')
                ->relationship('product', 'name')
                ->label('Produk')
                ->required(),

            Forms\Components\TextInput::make('name')->required()->label('Nama Lengkap'),
            Forms\Components\TextInput::make('phone')->label('Nomor HP'),
            Forms\Components\TextInput::make('email')->email()->label('Email'),

            // PROVINSI
            Forms\Components\Select::make('province_code')
                ->label('Provinsi')
                ->options(\Laravolt\Indonesia\Models\Province::pluck('name', 'code'))
                ->reactive()
                ->afterStateUpdated(fn($set) => $set('city_code', null))
                ->required(),

            // KOTA
            Forms\Components\Select::make('city_code')
                ->label('Kota/Kabupaten')
                ->options(
                    fn($get) =>
                    $get('province_code')
                        ? \Laravolt\Indonesia\Models\City::where('province_code', $get('province_code'))->pluck('name', 'code')
                        : []
                )
                ->reactive()
                ->afterStateUpdated(fn($set) => $set('district_code', null))
                ->required(),

            // KECAMATAN
            Forms\Components\Select::make('district_code')
                ->label('Kecamatan')
                ->options(
                    fn($get) =>
                    $get('city_code')
                        ? \Laravolt\Indonesia\Models\District::where('city_code', $get('city_code'))->pluck('name', 'code')
                        : []
                )
                ->reactive()
                ->afterStateUpdated(fn($set) => $set('village_code', null))
                ->required(),

            // KELURAHAN
            Forms\Components\Select::make('village_code')
                ->label('Kelurahan/Desa')
                ->options(
                    fn($get) =>
                    $get('district_code')
                        ? \Laravolt\Indonesia\Models\Village::where('district_code', $get('district_code'))->pluck('name', 'code')
                        : []
                )
                ->required(),

            Forms\Components\Textarea::make('alamat_spesifik')
                ->label('Alamat Spesifik')
                ->rows(3),

            Forms\Components\TextInput::make('koordinat')->label('Koordinat'),
            Forms\Components\TextInput::make('referral')->label('Referral'),
            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                ])
                ->default('pending')
                ->label('Status'),
        ]);
    }




    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Nama')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('product.name')
                ->label('Produk')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('province.name')
                ->label('Provinsi'),

            Tables\Columns\TextColumn::make('city.name')
                ->label('Kota/Kabupaten'),

            Tables\Columns\TextColumn::make('district.name')
                ->label('Kecamatan'),

            Tables\Columns\TextColumn::make('village.name')
                ->label('Kelurahan/Desa'),

            Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'warning' => 'pending',
                    'success' => 'approved',
                    'danger' => 'rejected',
                ]),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Tanggal Registrasi')
                ->dateTime('d M Y H:i')
                ->sortable(),
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
