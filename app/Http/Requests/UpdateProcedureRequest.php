<?php

namespace App\Http\Requests;

use App\Procedure;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateProcedureRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('procedure_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'title'             => [
                'required',
                'unique:procedures,title,' . request()->route('procedure')->id],
            'status'            => [
                'required'],
            'modality_id'       => [
                'required',
                'integer'],
            'procedure_type_id' => [
                'required',
                'integer'],
        ];

    }
}
