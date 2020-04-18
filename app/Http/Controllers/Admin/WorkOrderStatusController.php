<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyWorkOrderStatusRequest;
use App\Http\Requests\StoreWorkOrderStatusRequest;
use App\Http\Requests\UpdateWorkOrderStatusRequest;
use App\WorkOrderStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WorkOrderStatusController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('work_order_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = WorkOrderStatus::with(['created_by'])->select(sprintf('%s.*', (new WorkOrderStatus)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'work_order_status_show';
                $editGate      = 'work_order_status_edit';
                $deleteGate    = 'work_order_status_delete';
                $crudRoutePart = 'work-order-statuses';

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

        return view('admin.workOrderStatuses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('work_order_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.workOrderStatuses.create');
    }

    public function store(StoreWorkOrderStatusRequest $request)
    {
        $workOrderStatus = WorkOrderStatus::create($request->all());

        return redirect()->route('admin.work-order-statuses.index');

    }

    public function edit(WorkOrderStatus $workOrderStatus)
    {
        abort_if(Gate::denies('work_order_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workOrderStatus->load('created_by');

        return view('admin.workOrderStatuses.edit', compact('workOrderStatus'));
    }

    public function update(UpdateWorkOrderStatusRequest $request, WorkOrderStatus $workOrderStatus)
    {
        $workOrderStatus->update($request->all());

        return redirect()->route('admin.work-order-statuses.index');

    }

    public function show(WorkOrderStatus $workOrderStatus)
    {
        abort_if(Gate::denies('work_order_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workOrderStatus->load('created_by', 'workOrderStatusWorkOrders');

        return view('admin.workOrderStatuses.show', compact('workOrderStatus'));
    }

    public function destroy(WorkOrderStatus $workOrderStatus)
    {
        abort_if(Gate::denies('work_order_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workOrderStatus->delete();

        return back();

    }

    public function massDestroy(MassDestroyWorkOrderStatusRequest $request)
    {
        WorkOrderStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
