<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Resources\Admin\PatientResource;
use App\Patient;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('patient_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PatientResource(Patient::with(['created_by'])->get());

    }

    public function store(StorePatientRequest $request)
    {
        $patient = Patient::create($request->all());

        if ($request->input('files', false)) {
            $patient->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
        }

        return (new PatientResource($patient))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Patient $patient)
    {
        abort_if(Gate::denies('patient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PatientResource($patient->load(['created_by']));

    }

    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient->update($request->all());

        if ($request->input('files', false)) {
            if (!$patient->files || $request->input('files') !== $patient->files->file_name) {
                $patient->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
            }

        } elseif ($patient->files) {
            $patient->files->delete();
        }

        return (new PatientResource($patient))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Patient $patient)
    {
        abort_if(Gate::denies('patient_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patient->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
