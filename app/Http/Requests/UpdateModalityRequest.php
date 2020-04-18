<?php

namespace App\Http\Requests;

use App\Modality;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateModalityRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('modality_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'title' => [
                'required',
                'unique:modalities,title,' . request()->route('modality')->id],
            'satus' => [
                'required'],
        ];

    }
}
