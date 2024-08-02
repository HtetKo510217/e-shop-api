<?php

namespace App\Filament\Resources\CategoryclsResource\Pages;

use App\Filament\Resources\CategoryclsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategorycls extends EditRecord
{
    protected static string $resource = CategoryclsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
