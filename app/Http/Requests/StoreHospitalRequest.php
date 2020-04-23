<?php

namespace App\Http\Requests;

use App\Hospital;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreHospitalRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('hospital_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'title'        => [
                'required',
                'unique:hospitals'],
            'status'       => [
                'required'],
            'user_id'      => [
                'required',
                'integer'],
            'modalities.*' => [
                'integer'],
            'modalities'   => [
                'array'],
        ];

    }
}
