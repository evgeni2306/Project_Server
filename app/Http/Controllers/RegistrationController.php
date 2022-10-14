<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function createUserAction(Request $request): int|Response
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:users,login',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
        return Response(json_encode($validator->errors()->first()),$status = 404);
        }
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'login' => $request->login,
            'password' => Hash::make($request->password),
        ]);
        return ($user['id']);
    }
}
