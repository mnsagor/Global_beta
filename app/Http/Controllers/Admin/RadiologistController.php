<?php

namespace App\Http\Controllers\Admin;

use App\Hospital;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRadiologistRequest;
use App\Http\Requests\StoreRadiologistRequest;
use App\Http\Requests\UpdateRadiologistRequest;
use App\Macro;
use App\Modality;
use App\Radiologist;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class RadiologistController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('radiologist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $radiologists = Radiologist::all();

        return view('admin.radiologists.index', compact('radiologists'));
    }

    public function create()
    {
        abort_if(Gate::denies('radiologist_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hospitals = Hospital::all()->pluck('title', 'id');

        $modalities = Modality::all()->pluck('title', 'id');

        $macros = Macro::all()->pluck('title', 'id');

        return view('admin.radiologists.create', compact('hospitals', 'modalities', 'macros'));
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

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $radiologist->id]);
        }

        return redirect()->route('admin.radiologists.index');

    }

    public function edit(Radiologist $radiologist)
    {
        abort_if(Gate::denies('radiologist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hospitals = Hospital::all()->pluck('title', 'id');

        $modalities = Modality::all()->pluck('title', 'id');

        $macros = Macro::all()->pluck('title', 'id');

        $radiologist->load('hospitals', 'modalities', 'macros', 'created_by');

        return view('admin.radiologists.edit', compact('hospitals', 'modalities', 'macros', 'radiologist'));
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

        return redirect()->route('admin.radiologists.index');

    }

    public function show(Radiologist $radiologist)
    {
        abort_if(Gate::denies('radiologist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $radiologist->load('hospitals', 'modalities', 'macros', 'created_by', 'radiologistWorkOrders');

        return view('admin.radiologists.show', compact('radiologist'));
    }

    public function destroy(Radiologist $radiologist)
    {
        abort_if(Gate::denies('radiologist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $radiologist->delete();

        return back();

    }

    public function massDestroy(MassDestroyRadiologistRequest $request)
    {
        Radiologist::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('radiologist_create') && Gate::denies('radiologist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Radiologist();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}
