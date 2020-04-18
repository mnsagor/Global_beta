<?php

namespace App\Http\Requests;

use App\Modality;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyModalityRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('modality_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:modalities,id',
        ];

    }
}
