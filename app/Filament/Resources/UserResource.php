<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->state([
                'repeatable' => [
                    [
                        'name' => 'John Doe',
                        'email' => 'john@example.com',
                    ],
                    [
                        'name' => 'Jane Doe',
                        'email' => 'jane@example.com',
                    ],
                ],
            ])
            ->schema([
                Infolists\Components\RepeatableEntry::make('repeatable')
                    ->schema([
                        Infolists\Components\Section::make('test')
                            // both repeatable entries show the data of the first entry
                            ->schema([
                                Infolists\Components\TextEntry::make('name'),
                                Infolists\Components\TextEntry::make('email'),
                            ])
                            // uncommenting the lines below, where schema is returned as a closure, fixes the issue
                            // ->schema(fn () =>[
                            //     Infolists\Components\TextEntry::make('name'),
                            //     Infolists\Components\TextEntry::make('email'),
                            // ])
                    ]),
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
