<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProcedureTypeRequest;
use App\Http\Requests\StoreProcedureTypeRequest;
use App\Http\Requests\UpdateProcedureTypeRequest;
use App\ProcedureType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProcedureTypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('procedure_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProcedureType::with(['created_by'])->select(sprintf('%s.*', (new ProcedureType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'procedure_type_show';
                $editGate      = 'procedure_type_edit';
                $deleteGate    = 'procedure_type_delete';
                $crudRoutePart = 'procedure-types';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.procedureTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('procedure_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.procedureTypes.create');
    }

    public function store(StoreProcedureTypeRequest $request)
    {
        $procedureType = ProcedureType::create($request->all());

        return redirect()->route('admin.procedure-types.index');

    }

    public function edit(ProcedureType $procedureType)
    {
        abort_if(Gate::denies('procedure_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $procedureType->load('created_by');

        return view('admin.procedureTypes.edit', compact('procedureType'));
    }

    public function update(UpdateProcedureTypeRequest $request, ProcedureType $procedureType)
    {
        $procedureType->update($request->all());

        return redirect()->route('admin.procedure-types.index');

    }

    public function show(ProcedureType $procedureType)
    {
        abort_if(Gate::denies('procedure_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $procedureType->load('created_by', 'procedureTypeProcedures');

        return view('admin.procedureTypes.show', compact('procedureType'));
    }

    public function destroy(ProcedureType $procedureType)
    {
        abort_if(Gate::denies('procedure_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $procedureType->delete();

        return back();

    }

    public function massDestroy(MassDestroyProcedureTypeRequest $request)
    {
        ProcedureType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
