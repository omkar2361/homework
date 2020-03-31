<?php

namespace App\Http\Controllers;

use App\Model\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index()
    {
        return Person::all();
    }

    public function show($id)
    {
        return Person::findOrFail($id);
    }

    public function store(Request $request)
    {
        Person::store($request);
    }

    public function update(Request $request, $id)
    {
        $person = Person::findOrFail($id);

        $person->updatePerson($request);
    }

    public function destroy($id)
    {
        Person::findOrFail($id)->delete();
    }
}
