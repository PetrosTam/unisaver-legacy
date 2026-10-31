<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use App\Models\Order;

class LatestOrders extends BaseWidget
{
    Protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')
                ->label('Order ID')
                ->searchable(),

                TextColumn::make('user.name')
                ->label('Customer')
                ->searchable(),

                TextColumn::make('grand_total')
                ->label('Total')
                ->money('GBP'),

                TextColumn::make('payment_status')
                ->label('Payment Status')
                ->sortable()
                ->badge()
                ->searchable()
                ->color(fn (string $state): string => match ($state) {
                    'pending' => 'info',
                    'paid' => 'success',
                    'failed' => 'danger'
                }),

                TextColumn::make('payment_method')
                ->label('Payment Method')
                ->sortable()
                ->searchable(),

                TextColumn::make('status')
                ->label('Order Status')
                ->badge()
                ->searchable()
                ->color(fn (string $state): string => match ($state) {
                    'new' => 'info',
                    'processing' => 'warning',
                    'shipped' => 'success',
                    'delivered' => 'success',
                    'canceled' => 'danger'
                })
                ->icon(fn (string $state): string => match ($state) {
                    'new' => 'heroicon-m-sparkles',
                    'processing' => 'heroicon-m-arrow-path',
                    'shipped' => 'heroicon-m-truck',
                    'delivered' => 'heroicon-m-check-badge',
                    'canceled' => 'heroicon-m-x-circle'
                })
                ->sortable(),

                TextColumn::make('created_at')
                ->label('Order Date & Time')
                ->dateTime()
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('View Order')
                    ->url(fn (Order $record):string => OrderResource::getUrl('view', ['record' => $record]))
                    ->color('info')
                    ->icon('heroicon-o-eye'),
                    DeleteAction::make(),
                    ])
                ]);
    }
}
