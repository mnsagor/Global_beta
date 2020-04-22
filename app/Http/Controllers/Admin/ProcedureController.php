<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProcedureRequest;
use App\Http\Requests\StoreProcedureRequest;
use App\Http\Requests\UpdateProcedureRequest;
use App\Modality;
use App\Procedure;
use App\ProcedureType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProcedureController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('procedure_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Procedure::with(['modality', 'procedure_type', 'created_by'])->select(sprintf('%s.*', (new Procedure)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'procedure_show';
                $editGate      = 'procedure_edit';
                $deleteGate    = 'procedure_delete';
                $crudRoutePart = 'procedures';

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
            $table->editColumn('status', function ($row) {
                return $row->status ? Procedure::STATUS_SELECT[$row->status] : '';
            });
            $table->addColumn('modality_title', function ($row) {
                return $row->modality ? $row->modality->title : '';
            });

            $table->addColumn('procedure_type_title', function ($row) {
                return $row->procedure_type ? $row->procedure_type->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'modality', 'procedure_type']);

            return $table->make(true);
        }

        return view('admin.procedures.index');
    }

    public function create()
    {
        abort_if(Gate::denies('procedure_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modalities = Modality::all()->where('status',1)->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $procedure_types = ProcedureType::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.procedures.create', compact('modalities', 'procedure_types'));
    }

    public function store(StoreProcedureRequest $request)
    {
        $procedure = Procedure::create($request->all());

        return redirect()->route('admin.procedures.index');

    }

    public function edit(Procedure $procedure)
    {
        abort_if(Gate::denies('procedure_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modalities = Modality::all()->where('status',1)->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $procedure_types = ProcedureType::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $procedure->load('modality', 'procedure_type', 'created_by');

        return view('admin.procedures.edit', compact('modalities', 'procedure_types', 'procedure'));
    }

    public function update(UpdateProcedureRequest $request, Procedure $procedure)
    {
        $procedure->update($request->all());

        return redirect()->route('admin.procedures.index');

    }

    public function show(Procedure $procedure)
    {
        abort_if(Gate::denies('procedure_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $procedure->load('modality', 'procedure_type', 'created_by', 'procedureMacros', 'procedureWorkOrders');

        return view('admin.procedures.show', compact('procedure'));
    }

    public function destroy(Procedure $procedure)
    {
        abort_if(Gate::denies('procedure_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $procedure->delete();

        return back();

    }

    public function massDestroy(MassDestroyProcedureRequest $request)
    {
        Procedure::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
