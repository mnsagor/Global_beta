<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BillPaymentAndReceiveController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bill_payment_and_receive_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.billPaymentAndReceives.index');
    }
}
