<?php

namespace App\Http\Controllers\Admin;

use App\AssetsHistory;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetsHistoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('assets_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetsHistories = AssetsHistory::all();

        return view('admin.assetsHistories.index', compact('assetsHistories'));
    }
}
