<?php

namespace App\Http\Requests;

use App\Radiologist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateRadiologistRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('radiologist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name'         => [
                'required'],
            'roles.*'      => [
                'integer'],
            'roles'        => [
                'required',
                'array'],
            'hospitals.*'  => [
                'integer'],
            'hospitals'    => [
                'array'],
            'gender'       => [
                'required'],
            'modalities.*' => [
                'integer'],
            'modalities'   => [
                'array'],
            'macros.*'     => [
                'integer'],
            'macros'       => [
                'array'],
        ];

    }
}
