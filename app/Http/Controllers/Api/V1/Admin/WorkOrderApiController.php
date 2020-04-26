<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreWorkOrderRequest;
use App\Http\Requests\UpdateWorkOrderRequest;
use App\Http\Resources\Admin\WorkOrderResource;
use App\WorkOrder;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkOrderApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('work_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

//        return new WorkOrderResource(WorkOrder::with(['work_order_status', 'uploaded_by', 'hospital', 'doctor', 'patient', 'modality', 'procedures', 'radiologist', 'created_by'])->get());
        return new WorkOrderResource(WorkOrder::with(['work_order_status', 'uploaded_by', 'hospital', 'doctor', 'patient', 'modality', 'procedure', 'radiologist', 'created_by'])->get());

    }

    public function store(StoreWorkOrderRequest $request)
    {
        $workOrder = WorkOrder::create($request->all());
//        $workOrder->procedures()->sync($request->input('procedures', []));

        if ($request->input('image', false)) {
            $workOrder->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        return (new WorkOrderResource($workOrder))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(WorkOrder $workOrder)
    {
        abort_if(Gate::denies('work_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

//        return new WorkOrderResource($workOrder->load(['work_order_status', 'uploaded_by', 'hospital', 'doctor', 'patient', 'modality', 'procedures', 'radiologist', 'created_by']));
        return new WorkOrderResource($workOrder->load(['work_order_status', 'uploaded_by', 'hospital', 'doctor', 'patient', 'modality', 'procedure', 'radiologist', 'created_by']));


    }

    public function update(UpdateWorkOrderRequest $request, WorkOrder $workOrder)
    {
        $workOrder->update($request->all());
//        $workOrder->procedures()->sync($request->input('procedures', []));

        if ($request->input('image', false)) {
            if (!$workOrder->image || $request->input('image') !== $workOrder->image->file_name) {
                $workOrder->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }

        } elseif ($workOrder->image) {
            $workOrder->image->delete();
        }

        return (new WorkOrderResource($workOrder))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(WorkOrder $workOrder)
    {
        abort_if(Gate::denies('work_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workOrder->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
