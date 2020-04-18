<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMacroRequest;
use App\Http\Requests\UpdateMacroRequest;
use App\Http\Resources\Admin\MacroResource;
use App\Macro;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MacrosApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('macro_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MacroResource(Macro::with(['modality', 'procedure', 'created_by'])->get());

    }

    public function store(StoreMacroRequest $request)
    {
        $macro = Macro::create($request->all());

        return (new MacroResource($macro))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Macro $macro)
    {
        abort_if(Gate::denies('macro_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MacroResource($macro->load(['modality', 'procedure', 'created_by']));

    }

    public function update(UpdateMacroRequest $request, Macro $macro)
    {
        $macro->update($request->all());

        return (new MacroResource($macro))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Macro $macro)
    {
        abort_if(Gate::denies('macro_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $macro->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
