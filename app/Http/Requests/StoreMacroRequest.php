<?php

namespace App\Http\Requests;

use App\Macro;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreMacroRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('macro_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'title'        => [
                'required'],
            'modality_id'  => [
                'required',
                'integer'],
            'procedure_id' => [
                'required',
                'integer'],
            'status'       => [
                'required'],
            'details'      => [
                'required'],
        ];

    }
}
