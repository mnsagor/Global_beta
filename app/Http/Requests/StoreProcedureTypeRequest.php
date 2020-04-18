<?php

namespace App\Http\Requests;

use App\ProcedureType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreProcedureTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('procedure_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'title' => [
                'required',
                'unique:procedure_types'],
        ];

    }
}
