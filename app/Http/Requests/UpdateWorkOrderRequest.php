<?php

namespace App\Http\Requests;

use App\WorkOrder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateWorkOrderRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('work_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'registration_number'  => [
                'required',
                'unique:work_orders,registration_number,' . request()->route('work_order')->id],
            'work_order_status_id' => [
                'required',
                'integer'],
            'uploaded_by_id'       => [
                'required',
                'integer'],
            'data'                 => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format')],
            'hospital_id'          => [
                'required',
                'integer'],
            'doctor_id'            => [
                'required',
                'integer'],
            'patient_id'           => [
                'required',
                'integer'],
            'procedure_id'         => [
                'required',
                'integer'],
        ];

    }
}
