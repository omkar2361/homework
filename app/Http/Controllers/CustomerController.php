<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::all();
    }

    public function show($id)
    {
        return Customer::findOrFail($id);
    }

    public function store(Request $request)
    {
        //Validate data
        $this->validateData($request->all(), Customer::validationRules($request));

        Customer::store($request);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $this->validateData($request->all(), Customer::validationRules($request));

        $customer->updateCustomer($request);

    }

    public function destroy($id)
    {
        Customer::findOrFail($id)->delete();
    }
}
