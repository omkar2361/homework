<?php

namespace App\Http\Controllers;

use App\AccountCategory;
use Illuminate\Http\Request;

class AccountCategoryController extends Controller
{
    public function index()
    {
        return AccountCategory::all();
    }

    public function show($id)
    {
        return AccountCategory::findOrFail($id);
    }

    public function store(Request $request)
    {
        //Validate data
        $this->validateData($request->all(), AccountCategory::validationRules());

        AccountCategory::store($request);
    }

    public function update(Request $request, $id)
    {
        //Get Record
        $account_catgegory = AccountCategory::findOrFail($id);

        //Validate
        $this->validateData($request->all(), AccountCategory::validationRules($account_catgegory->id));

        $account_catgegory->updateAccountCategory($request);

    }

    public function destroy($id)
    {
        AccountCategory::findOrfail($id)->delete();
    }
}
