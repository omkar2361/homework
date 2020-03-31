<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return Payment::all();
    }

    public function show($id)
    {
        return Payment::findOrFail($id);
    }

    public function store(Request $request)
    {
        //Validate data
        $this->validateData($request->all(), Payment::validationRules());

        Payment::store($request);
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        //Validate data
        $this->validateData($request->all(), Payment::validationRules());
    }

    public function destroy($id)
    {
        Payment::findOrFail($id)->delete();
    }
}
