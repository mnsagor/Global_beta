<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkOrderStatusRequest;
use App\Http\Requests\UpdateWorkOrderStatusRequest;
use App\Http\Resources\Admin\WorkOrderStatusResource;
use App\WorkOrderStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkOrderStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('work_order_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkOrderStatusResource(WorkOrderStatus::with(['created_by'])->get());

    }

    public function store(StoreWorkOrderStatusRequest $request)
    {
        $workOrderStatus = WorkOrderStatus::create($request->all());

        return (new WorkOrderStatusResource($workOrderStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(WorkOrderStatus $workOrderStatus)
    {
        abort_if(Gate::denies('work_order_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkOrderStatusResource($workOrderStatus->load(['created_by']));

    }

    public function update(UpdateWorkOrderStatusRequest $request, WorkOrderStatus $workOrderStatus)
    {
        $workOrderStatus->update($request->all());

        return (new WorkOrderStatusResource($workOrderStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(WorkOrderStatus $workOrderStatus)
    {
        abort_if(Gate::denies('work_order_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workOrderStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
