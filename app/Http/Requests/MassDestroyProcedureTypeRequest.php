<?php

namespace App\Http\Requests;

use App\ProcedureType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProcedureTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('procedure_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:procedure_types,id',
        ];

    }
}
