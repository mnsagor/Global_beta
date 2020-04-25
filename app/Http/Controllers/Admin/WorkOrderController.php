<?php

namespace App\Http\Controllers\Admin;

use App\Doctor;
use App\Hospital;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyWorkOrderRequest;
use App\Http\Requests\StoreWorkOrderRequest;
use App\Http\Requests\UpdateWorkOrderRequest;
use App\Modality;
use App\Patient;
use App\Procedure;
use App\Radiologist;
use App\User;
use App\WorkOrder;
use App\WorkOrderStatus;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WorkOrderController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('work_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = WorkOrder::with(['work_order_status', 'uploaded_by', 'hospital', 'doctor', 'patient', 'modality', 'procedure', 'radiologist', 'created_by'])->select(sprintf('%s.*', (new WorkOrder)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'work_order_show';
                $editGate      = 'work_order_edit';
                $deleteGate    = 'work_order_delete';
                $crudRoutePart = 'work-orders';

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
            $table->editColumn('registration_number', function ($row) {
                return $row->registration_number ? $row->registration_number : "";
            });
            $table->addColumn('work_order_status_title', function ($row) {
                return $row->work_order_status ? $row->work_order_status->title : '';
            });

            $table->addColumn('uploaded_by_name', function ($row) {
                return $row->uploaded_by ? $row->uploaded_by->name : '';
            });

            $table->addColumn('hospital_title', function ($row) {
                return $row->hospital ? $row->hospital->title : '';
            });

            $table->addColumn('doctor_name', function ($row) {
                return $row->doctor ? $row->doctor->name : '';
            });

            $table->addColumn('patient_name', function ($row) {
                return $row->patient ? $row->patient->name : '';
            });

            $table->addColumn('modality_title', function ($row) {
                return $row->modality ? $row->modality->title : '';
            });

            $table->addColumn('procedure_title', function ($row) {
                return $row->procedure ? $row->procedure->title : '';
            });

            $table->addColumn('radiologist_name', function ($row) {
                return $row->radiologist ? $row->radiologist->name : '';
            });

            $table->editColumn('image', function ($row) {
                if (!$row->image) {
                    return '';
                }

                $links = [];

                foreach ($row->image as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'work_order_status', 'uploaded_by', 'hospital', 'doctor', 'patient', 'modality', 'procedure', 'radiologist', 'image']);

            return $table->make(true);
        }

        return view('admin.workOrders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('work_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $work_order_statuses = WorkOrderStatus::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $uploaded_bies = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hospitals = Hospital::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = Doctor::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patients = Patient::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $modalities = Modality::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $procedures = Procedure::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $radiologists = Radiologist::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.workOrders.create', compact('work_order_statuses', 'uploaded_bies', 'hospitals', 'doctors', 'patients', 'modalities', 'procedures', 'radiologists'));
    }

    public function store(StoreWorkOrderRequest $request)
    {
        $workOrder = WorkOrder::create($request->all());

        foreach ($request->input('image', []) as $file) {
            $workOrder->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $workOrder->id]);
        }

        return redirect()->route('admin.work-orders.index');

    }

    public function edit(WorkOrder $workOrder)
    {
        abort_if(Gate::denies('work_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $work_order_statuses = WorkOrderStatus::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $uploaded_bies = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hospitals = Hospital::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = Doctor::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patients = Patient::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $modalities = Modality::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $procedures = Procedure::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $radiologists = Radiologist::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workOrder->load('work_order_status', 'uploaded_by', 'hospital', 'doctor', 'patient', 'modality', 'procedure', 'radiologist', 'created_by');

        return view('admin.workOrders.edit', compact('work_order_statuses', 'uploaded_bies', 'hospitals', 'doctors', 'patients', 'modalities', 'procedures', 'radiologists', 'workOrder'));
    }

    public function update(UpdateWorkOrderRequest $request, WorkOrder $workOrder)
    {
        $workOrder->update($request->all());

        if (count($workOrder->image) > 0) {
            foreach ($workOrder->image as $media) {
                if (!in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }

            }

        }

        $media = $workOrder->image->pluck('file_name')->toArray();

        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $workOrder->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
            }

        }

        return redirect()->route('admin.work-orders.index');

    }

    public function show(WorkOrder $workOrder)
    {
        abort_if(Gate::denies('work_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workOrder->load('work_order_status', 'uploaded_by', 'hospital', 'doctor', 'patient', 'modality', 'procedure', 'radiologist', 'created_by');

        return view('admin.workOrders.show', compact('workOrder'));
    }

    public function destroy(WorkOrder $workOrder)
    {
        abort_if(Gate::denies('work_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workOrder->delete();

        return back();

    }

    public function massDestroy(MassDestroyWorkOrderRequest $request)
    {
        WorkOrder::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('work_order_create') && Gate::denies('work_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new WorkOrder();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}
