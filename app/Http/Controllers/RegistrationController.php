<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function createUserAction(Request $request): string|Response
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:users,login',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return Response(json_encode(['message' => $validator->errors()->first()]), $status = 404, ['Content-Type' => 'string']);
        }
        $fields = $request->all();
        $fields['key']=time();
        $user = User::create($fields);
        return json_encode(['key' => $user['key']]);
    }
}
