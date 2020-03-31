<?php

namespace App\Http\Controllers;

use App\Model\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return Account::all();
    }

    public function show($id)
    {
        return Account::findOrFail($id);
    }

    public function store(Request $request)
    {

        Account::store($request);
    }

    public function update(Request $request, $id)
    {
        //Get Record
        $account = Account::findOrFail($id);

        $account->updateAccount($request);

    }

    public function destroy($id)
    {
        Account::findOrfail($id)->delete();
    }
}
