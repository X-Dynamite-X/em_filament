<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    // protected function getCreatedNotificationTitle(): ? string {
    //     return "User is Cerated" ;
    // }

    protected function getCreatedNotification(): ?Notification {
        return Notification::make()
        ->title('Saved successfully')
        ->success()
        ->body('Changes to the post have been saved.')
        ->send();
    }
}
