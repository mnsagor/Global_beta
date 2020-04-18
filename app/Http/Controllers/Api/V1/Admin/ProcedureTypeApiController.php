<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProcedureTypeRequest;
use App\Http\Requests\UpdateProcedureTypeRequest;
use App\Http\Resources\Admin\ProcedureTypeResource;
use App\ProcedureType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProcedureTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('procedure_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProcedureTypeResource(ProcedureType::with(['created_by'])->get());

    }

    public function store(StoreProcedureTypeRequest $request)
    {
        $procedureType = ProcedureType::create($request->all());

        return (new ProcedureTypeResource($procedureType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(ProcedureType $procedureType)
    {
        abort_if(Gate::denies('procedure_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProcedureTypeResource($procedureType->load(['created_by']));

    }

    public function update(UpdateProcedureTypeRequest $request, ProcedureType $procedureType)
    {
        $procedureType->update($request->all());

        return (new ProcedureTypeResource($procedureType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(ProcedureType $procedureType)
    {
        abort_if(Gate::denies('procedure_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $procedureType->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
