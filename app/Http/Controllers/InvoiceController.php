<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class InvoiceController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        //write code here...
    }

    public function show($id)
    {
        //write code here...
    }

    public function store(Request $request)
    {
        Invoice::store($request);
    }

    public function update(Request $request, $id)
    {
        //write code here...
    }

    public function destroy($id)
    {
        //write code here...
    }
}
