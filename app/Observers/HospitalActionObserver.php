<?php

namespace App\Observers;

use App\Hospital;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class HospitalActionObserver
{
    public function created(Hospital $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Hospital'];
        $users = \App\User::whereHas('roles', function ($q) {return $q->where('title', 'Admin');})->get();
        Notification::send($users, new DataChangeEmailNotification($data));

    }

    public function updated(Hospital $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Hospital'];
        $users = \App\User::whereHas('roles', function ($q) {return $q->where('title', 'Admin');})->get();
        Notification::send($users, new DataChangeEmailNotification($data));

    }

    public function deleting(Hospital $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Hospital'];
        $users = \App\User::whereHas('roles', function ($q) {return $q->where('title', 'Admin');})->get();
        Notification::send($users, new DataChangeEmailNotification($data));

    }
}
