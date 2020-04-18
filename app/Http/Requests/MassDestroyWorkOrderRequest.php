<?php

namespace App\Http\Requests;

use App\WorkOrder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWorkOrderRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('work_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:work_orders,id',
        ];

    }
}
