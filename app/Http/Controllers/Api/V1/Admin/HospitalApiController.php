<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Hospital;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreHospitalRequest;
use App\Http\Requests\UpdateHospitalRequest;
use App\Http\Resources\Admin\HospitalResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HospitalApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('hospital_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HospitalResource(Hospital::with(['roles', 'created_by'])->get());

    }

    public function store(StoreHospitalRequest $request)
    {
        $hospital = Hospital::create($request->all());
        $hospital->roles()->sync($request->input('roles', []));

        return (new HospitalResource($hospital))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Hospital $hospital)
    {
        abort_if(Gate::denies('hospital_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HospitalResource($hospital->load(['roles', 'created_by']));

    }

    public function update(UpdateHospitalRequest $request, Hospital $hospital)
    {
        $hospital->update($request->all());
        $hospital->roles()->sync($request->input('roles', []));

        return (new HospitalResource($hospital))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Hospital $hospital)
    {
        abort_if(Gate::denies('hospital_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hospital->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
