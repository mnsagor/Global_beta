<?php

namespace App\Http\Requests;

use App\WorkOrderStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreWorkOrderStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('work_order_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'title' => [
                'required',
                'unique:work_order_statuses'],
        ];

    }
}
