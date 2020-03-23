<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return Transaction::all();
    }

    public function show($id)
    {
        return Transaction::findOrFail($id);
    }

    public function store(Request $request)
    {
        //Validate
        $this->validateData($request->all(), Transaction::validationRules());

        //Store
        Transaction::store($request);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        //Validate
        $this->validateData($request->all(), Transaction::validationRules());

        $transaction->updateTransaction($request);
    }

    public function destroy($id)
    {
        Transaction::findOrFail($id)->delete();
    }
}
