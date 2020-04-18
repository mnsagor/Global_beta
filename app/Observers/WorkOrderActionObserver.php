<?php

namespace App\Observers;

use App\Notifications\DataChangeEmailNotification;
use App\WorkOrder;
use Illuminate\Support\Facades\Notification;

class WorkOrderActionObserver
{
    public function created(WorkOrder $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'WorkOrder'];
        $users = \App\User::whereHas('roles', function ($q) {return $q->where('title', 'Admin');})->get();
        Notification::send($users, new DataChangeEmailNotification($data));

    }

    public function updated(WorkOrder $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'WorkOrder'];
        $users = \App\User::whereHas('roles', function ($q) {return $q->where('title', 'Admin');})->get();
        Notification::send($users, new DataChangeEmailNotification($data));

    }

    public function deleting(WorkOrder $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'WorkOrder'];
        $users = \App\User::whereHas('roles', function ($q) {return $q->where('title', 'Admin');})->get();
        Notification::send($users, new DataChangeEmailNotification($data));

    }
}
