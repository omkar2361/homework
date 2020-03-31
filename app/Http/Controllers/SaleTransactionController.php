<?php

namespace App\Http\Controllers;

use App\SaleTransaction;
use Illuminate\Http\Request;

class SaleTransactionController extends Controller
{
    public function index()
    {
        return SaleTransaction::all();
    }

    public function show($id)
    {
        return SaleTransaction::findOrFail($id);
    }

    public function store(Request $request)
    {
        //Validate
        $this->validateData($request->all(), SaleTransaction::validationRules($request));
        //Store
        SaleTransaction::store($request);
    }

    public function update(Request $request, $id)
    {
        $sale_transaction = SaleTransaction::findOrFail($id);

        //Validate
        $this->validateData($request->all(), SaleTransaction::validationRules($request));

        $sale_transaction->updateSaleTransaction($request);
    }

    public function destroy($id)
    {
        SaleTransaction::findOrFail($id)->delete();
    }
}
