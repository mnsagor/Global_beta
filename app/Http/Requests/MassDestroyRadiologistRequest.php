<?php

namespace App\Http\Requests;

use App\Radiologist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRadiologistRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('radiologist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:radiologists,id',
        ];

    }
}
