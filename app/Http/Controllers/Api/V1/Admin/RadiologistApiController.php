<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreRadiologistRequest;
use App\Http\Requests\UpdateRadiologistRequest;
use App\Http\Resources\Admin\RadiologistResource;
use App\Radiologist;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RadiologistApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('radiologist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RadiologistResource(Radiologist::with(['hospitals', 'modalities', 'macros', 'created_by'])->get());

    }

    public function store(StoreRadiologistRequest $request)
    {
        $radiologist = Radiologist::create($request->all());
        $radiologist->hospitals()->sync($request->input('hospitals', []));
        $radiologist->modalities()->sync($request->input('modalities', []));
        $radiologist->macros()->sync($request->input('macros', []));

        if ($request->input('signature_image', false)) {
            $radiologist->addMedia(storage_path('tmp/uploads/' . $request->input('signature_image')))->toMediaCollection('signature_image');
        }

        return (new RadiologistResource($radiologist))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Radiologist $radiologist)
    {
        abort_if(Gate::denies('radiologist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RadiologistResource($radiologist->load(['hospitals', 'modalities', 'macros', 'created_by']));

    }

    public function update(UpdateRadiologistRequest $request, Radiologist $radiologist)
    {
        $radiologist->update($request->all());
        $radiologist->hospitals()->sync($request->input('hospitals', []));
        $radiologist->modalities()->sync($request->input('modalities', []));
        $radiologist->macros()->sync($request->input('macros', []));

        if ($request->input('signature_image', false)) {
            if (!$radiologist->signature_image || $request->input('signature_image') !== $radiologist->signature_image->file_name) {
                $radiologist->addMedia(storage_path('tmp/uploads/' . $request->input('signature_image')))->toMediaCollection('signature_image');
            }

        } elseif ($radiologist->signature_image) {
            $radiologist->signature_image->delete();
        }

        return (new RadiologistResource($radiologist))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Radiologist $radiologist)
    {
        abort_if(Gate::denies('radiologist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $radiologist->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
