<?php

namespace App\Http\Controllers\Admin;

use App\Hospital;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHospitalRequest;
use App\Http\Requests\StoreHospitalRequest;
use App\Http\Requests\UpdateHospitalRequest;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HospitalController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('hospital_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Hospital::with(['created_by'])->select(sprintf('%s.*', (new Hospital)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'hospital_show';
                $editGate      = 'hospital_edit';
                $deleteGate    = 'hospital_delete';
                $crudRoutePart = 'hospitals';

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
                return $row->status ? Hospital::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('hospital_code', function ($row) {
                return $row->hospital_code ? $row->hospital_code : "";
            });
            $table->editColumn('manager_name', function ($row) {
                return $row->manager_name ? $row->manager_name : "";
            });
            $table->editColumn('manager_phone_number', function ($row) {
                return $row->manager_phone_number ? $row->manager_phone_number : "";
            });
            $table->editColumn('techonologist_name', function ($row) {
                return $row->techonologist_name ? $row->techonologist_name : "";
            });
            $table->editColumn('technologist_phone_number', function ($row) {
                return $row->technologist_phone_number ? $row->technologist_phone_number : "";
            });
            $table->editColumn('receptionist_name', function ($row) {
                return $row->receptionist_name ? $row->receptionist_name : "";
            });
            $table->editColumn('receptionist_phone_number', function ($row) {
                return $row->receptionist_phone_number ? $row->receptionist_phone_number : "";
            });
            $table->editColumn('route_title', function ($row) {
                return $row->route_title ? $row->route_title : "";
            });
            $table->editColumn('route_ae_title', function ($row) {
                return $row->route_ae_title ? $row->route_ae_title : "";
            });
            $table->editColumn('route_host_name', function ($row) {
                return $row->route_host_name ? $row->route_host_name : "";
            });
            $table->editColumn('route_port', function ($row) {
                return $row->route_port ? $row->route_port : "";
            });
            $table->editColumn('pacs_destinaiton_ae_title', function ($row) {
                return $row->pacs_destinaiton_ae_title ? $row->pacs_destinaiton_ae_title : "";
            });
            $table->editColumn('pacs_ae_title', function ($row) {
                return $row->pacs_ae_title ? $row->pacs_ae_title : "";
            });
            $table->editColumn('pacs_host_name', function ($row) {
                return $row->pacs_host_name ? $row->pacs_host_name : "";
            });
            $table->editColumn('pacs_port', function ($row) {
                return $row->pacs_port ? $row->pacs_port : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.hospitals.index');
    }

    public function create()
    {
        abort_if(Gate::denies('hospital_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.hospitals.create');
    }

    public function store(StoreHospitalRequest $request)
    {
        $hospital = Hospital::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $hospital->id]);
        }

        return redirect()->route('admin.hospitals.index');

    }

    public function edit(Hospital $hospital)
    {
        abort_if(Gate::denies('hospital_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hospital->load('created_by');

        return view('admin.hospitals.edit', compact('hospital'));
    }

    public function update(UpdateHospitalRequest $request, Hospital $hospital)
    {
        $hospital->update($request->all());

        return redirect()->route('admin.hospitals.index');

    }

    public function show(Hospital $hospital)
    {
        abort_if(Gate::denies('hospital_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hospital->load('created_by', 'hospitalWorkOrders', 'hospitalRadiologists');

        return view('admin.hospitals.show', compact('hospital'));
    }

    public function destroy(Hospital $hospital)
    {
        abort_if(Gate::denies('hospital_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hospital->delete();

        return back();

    }

    public function massDestroy(MassDestroyHospitalRequest $request)
    {
        Hospital::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('hospital_create') && Gate::denies('hospital_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Hospital();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}
