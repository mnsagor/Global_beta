<?php

namespace App\Observers;

use App\Modality;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class ModalityActionObserver
{
    public function created(Modality $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Modality'];
        $users = \App\User::whereHas('roles', function ($q) {return $q->where('title', 'Admin');})->get();
        Notification::send($users, new DataChangeEmailNotification($data));

    }

    public function updated(Modality $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Modality'];
        $users = \App\User::whereHas('roles', function ($q) {return $q->where('title', 'Admin');})->get();
        Notification::send($users, new DataChangeEmailNotification($data));

    }

    public function deleting(Modality $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Modality'];
        $users = \App\User::whereHas('roles', function ($q) {return $q->where('title', 'Admin');})->get();
        Notification::send($users, new DataChangeEmailNotification($data));

    }
}
