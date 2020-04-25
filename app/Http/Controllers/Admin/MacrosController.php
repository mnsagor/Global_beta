<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMacroRequest;
use App\Http\Requests\StoreMacroRequest;
use App\Http\Requests\UpdateMacroRequest;
use App\Macro;
use App\Modality;
use App\Procedure;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MacrosController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('macro_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Macro::with(['modality', 'procedure', 'created_by'])->select(sprintf('%s.*', (new Macro)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'macro_show';
                $editGate      = 'macro_edit';
                $deleteGate    = 'macro_delete';
                $crudRoutePart = 'macros';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : "";
            });
            $table->addColumn('modality_title', function ($row) {
                return $row->modality ? $row->modality->title : '';
            });

            $table->addColumn('procedure_title', function ($row) {
                return $row->procedure ? $row->procedure->title : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? Macro::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'modality', 'procedure']);

            return $table->make(true);
        }

        return view('admin.macros.index');
    }

    public function create()
    {
        abort_if(Gate::denies('macro_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modalities = Modality::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $procedures = Procedure::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.macros.create', compact('modalities', 'procedures'));
    }

    public function store(StoreMacroRequest $request)
    {
        $macro = Macro::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $macro->id]);
        }

        return redirect()->route('admin.macros.index');

    }

    public function edit(Macro $macro)
    {
        abort_if(Gate::denies('macro_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modalities = Modality::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $procedures = Procedure::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $macro->load('modality', 'procedure', 'created_by');

        return view('admin.macros.edit', compact('modalities', 'procedures', 'macro'));
    }

    public function update(UpdateMacroRequest $request, Macro $macro)
    {
        $macro->update($request->all());

        return redirect()->route('admin.macros.index');

    }

    public function show(Macro $macro)
    {
        abort_if(Gate::denies('macro_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $macro->load('modality', 'procedure', 'created_by', 'macroRadiologists');

        return view('admin.macros.show', compact('macro'));
    }

    public function destroy(Macro $macro)
    {
        abort_if(Gate::denies('macro_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $macro->delete();

        return back();

    }

    public function massDestroy(MassDestroyMacroRequest $request)
    {
        Macro::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('macro_create') && Gate::denies('macro_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Macro();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}
