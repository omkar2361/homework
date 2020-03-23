<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\ValidationException;
use Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //Validate Data
    public function validateData($request, $rules, $messages = null)
    {
        if ($messages === null) {
            $messages = [];
        }

        //Customer validation
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->getMessages());
        }

    }
}
