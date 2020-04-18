<?php

namespace App\Observers;

use App\Doctor;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class DoctorActionObserver
{
    public function created(Doctor $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Doctor'];
        $users = \App\User::whereHas('roles', function ($q) {return $q->where('title', 'Admin');})->get();
        Notification::send($users, new DataChangeEmailNotification($data));

    }

    public function updated(Doctor $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Doctor'];
        $users = \App\User::whereHas('roles', function ($q) {return $q->where('title', 'Admin');})->get();
        Notification::send($users, new DataChangeEmailNotification($data));

    }

    public function deleting(Doctor $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Doctor'];
        $users = \App\User::whereHas('roles', function ($q) {return $q->where('title', 'Admin');})->get();
        Notification::send($users, new DataChangeEmailNotification($data));

    }
}
