<?php

namespace App\Http\Controllers;

use App\Model\Transaction;
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
        //Store
        Transaction::store($request);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->updateTransaction($request);
    }

    public function destroy($id)
    {
        Transaction::findOrFail($id)->delete();
    }
}
