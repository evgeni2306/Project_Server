<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function createUserAction(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:users,login',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return json_encode($validator->errors()->first());
        }
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'login' => $request->surname,
            'password' => Hash::make($request->password),
        ]);

        return ($user['id']);

    }
}
