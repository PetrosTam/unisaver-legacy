<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class AddressRelationManager extends RelationManager
{
    protected static string $relationship = 'address';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('first_name')
                ->label('First Name')
                ->required()
                ->maxLength(255),

                TextInput::make('last_name')
                ->label('Last Name')
                ->required()
                ->maxLength(255),

                TextInput::make('student_id')
                ->label('Student ID')
                ->required()
                ->maxLength(255),

                TextInput::make('phone')
                ->required()
                ->tel()
                ->maxLength(20),

                TextInput::make('city')
                ->required()
                ->maxLength(255),

                TextInput::make('postcode')
                ->required()
                ->maxLength(8),

                Textarea::make('street_address')
                ->label('Street Address')
                ->required()
                ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('street_address')
            ->columns([
                TextColumn::make('fullname')
                ->label('Full Name'),

                TextColumn::make('student_id')
                ->label('Student ID'),

                TextColumn::make('phone'),

                TextColumn::make('city'),

                TextColumn::make('postcode'),

                TextColumn::make('street_address')
                ->label('Street Address'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
