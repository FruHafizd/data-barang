<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DetailTransaksiResource\Pages;
use App\Filament\Resources\DetailTransaksiResource\RelationManagers;
use App\Models\Barang;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DetailTransaksiResource extends Resource
{
    protected static ?string $model = DetailTransaksi::class;

    public static function getModelLabel(): string
    {
        return __('Detail Transcation');
    }


    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Select::make('transaksi_id')
                ->label('Transaction')
                ->options(Transaksi::all()->pluck('tanggal_transaksi', 'id'))
                ->required(),
            Select::make('barang_id')
                ->label('Product')
                ->options(Barang::all()->pluck('nama_barang', 'id'))
                ->required(),
            TextInput::make('kuantitas')
                ->label('Quantity')
                ->required(),
            TextInput::make('harga_satuan')
                ->label('Unit Price')
                ->required(),
            TextInput::make('subtotal')
                ->label('Subtotal')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListDetailTransaksis::route('/'),
            'create' => Pages\CreateDetailTransaksi::route('/create'),
            'edit' => Pages\EditDetailTransaksi::route('/{record}/edit'),
        ];
    }
}
