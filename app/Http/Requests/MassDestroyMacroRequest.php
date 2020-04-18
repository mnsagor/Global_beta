<?php

namespace App\Http\Requests;

use App\Macro;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMacroRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('macro_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:macros,id',
        ];

    }
}
