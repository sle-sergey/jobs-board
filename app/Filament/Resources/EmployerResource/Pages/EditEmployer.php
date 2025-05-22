<?php

namespace App\Filament\Resources\EmployerResource\Pages;

use App\Filament\Resources\EmployerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;

class EditEmployer extends EditRecord
{
    protected static string $resource = EmployerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function () {
                    DB::transaction(function () {
                        $this->record->jobs()->withTrashed()->forceDelete();
                        $this->record->delete(); // optional, Filament may call this too
                    });
                }),
        ];
    }

}
