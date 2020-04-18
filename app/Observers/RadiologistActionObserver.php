<?php

namespace App\Observers;

use App\Notifications\DataChangeEmailNotification;
use App\Radiologist;
use Illuminate\Support\Facades\Notification;

class RadiologistActionObserver
{
    public function created(Radiologist $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Radiologist'];
        $users = \App\User::whereHas('roles', function ($q) {return $q->where('title', 'Admin');})->get();
        Notification::send($users, new DataChangeEmailNotification($data));

    }

    public function updated(Radiologist $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Radiologist'];
        $users = \App\User::whereHas('roles', function ($q) {return $q->where('title', 'Admin');})->get();
        Notification::send($users, new DataChangeEmailNotification($data));

    }

    public function deleting(Radiologist $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Radiologist'];
        $users = \App\User::whereHas('roles', function ($q) {return $q->where('title', 'Admin');})->get();
        Notification::send($users, new DataChangeEmailNotification($data));

    }
}
