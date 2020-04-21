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
use App\Role;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RadiologistController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('radiologist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Radiologist::with(['roles', 'hospitals', 'modalities', 'macros', 'created_by'])->select(sprintf('%s.*', (new Radiologist)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'radiologist_show';
                $editGate      = 'radiologist_edit';
                $deleteGate    = 'radiologist_delete';
                $crudRoutePart = 'radiologists';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('roles', function ($row) {
                $labels = [];

                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : "";
            });
            $table->editColumn('designation', function ($row) {
                return $row->designation ? $row->designation : "";
            });
            $table->editColumn('hospital', function ($row) {
                $labels = [];

                foreach ($row->hospitals as $hospital) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $hospital->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('gender', function ($row) {
                return $row->gender ? Radiologist::GENDER_SELECT[$row->gender] : '';
            });
            $table->editColumn('modality', function ($row) {
                $labels = [];

                foreach ($row->modalities as $modality) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $modality->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('macro', function ($row) {
                $labels = [];

                foreach ($row->macros as $macro) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $macro->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('signature_image', function ($row) {
                if ($photo = $row->signature_image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';

            });

            $table->rawColumns(['actions', 'placeholder', 'roles', 'hospital', 'modality', 'macro', 'signature_image']);

            return $table->make(true);
        }

        return view('admin.radiologists.index');
    }

    public function create()
    {
        abort_if(Gate::denies('radiologist_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        $hospitals = Hospital::all()->pluck('title', 'id');

        $modalities = Modality::all()->pluck('title', 'id');

        $macros = Macro::all()->pluck('title', 'id');

        return view('admin.radiologists.create', compact('roles', 'hospitals', 'modalities', 'macros'));
    }

    public function store(StoreRadiologistRequest $request)
    {
        $radiologist = Radiologist::create($request->all());
        $radiologist->roles()->sync($request->input('roles', []));
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

        $roles = Role::all()->pluck('title', 'id');

        $hospitals = Hospital::all()->pluck('title', 'id');

        $modalities = Modality::all()->pluck('title', 'id');

        $macros = Macro::all()->pluck('title', 'id');

        $radiologist->load('roles', 'hospitals', 'modalities', 'macros', 'created_by');

        return view('admin.radiologists.edit', compact('roles', 'hospitals', 'modalities', 'macros', 'radiologist'));
    }

    public function update(UpdateRadiologistRequest $request, Radiologist $radiologist)
    {
        $radiologist->update($request->all());
        $radiologist->roles()->sync($request->input('roles', []));
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

        $radiologist->load('roles', 'hospitals', 'modalities', 'macros', 'created_by', 'radiologistWorkOrders');

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
