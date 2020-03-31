<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return Service::all();
    }

    public function show($id)
    {
        return Service::findOrFail($id);
    }

    public function store(Request $request)
    {

        Service::store($request);
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $service->updateService($request);
    }

    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
    }
}
