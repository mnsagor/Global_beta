<?php

namespace App\Http\Requests;

use App\Hospital;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateHospitalRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('hospital_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'title'   => [
                'required',
                'unique:hospitals,title,' . request()->route('hospital')->id],
            'roles.*' => [
                'integer'],
            'roles'   => [
                'required',
                'array'],
        ];

    }
}
