<?php

namespace App\Http\Controllers;

use App\Model\TimeActivity;
use Illuminate\Http\Request;

class TimeActivityController extends Controller
{
    public function index()
    {
        return TimeActivity::all();
    }

    public function store(Request $request)
    {
        TimeActivity::store($request);

    }

    public function show($id)
    {
        return TimeActivity::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $activity = TimeActivity::findOrFail($id);

        $activity->updateActivity();
    }

    public function destroy($id)
    {
        TimeActivity::findOrFail($id)->delete();
    }
}
