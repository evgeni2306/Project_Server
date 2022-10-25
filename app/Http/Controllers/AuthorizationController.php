<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthorizationController extends Controller
{
    public function loginUserAction(Request $request): string|Response
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string|max:255',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return Response(json_encode(['message' => 'Поле заполненно некорректно']), $status = 404, ['Content-Type' => 'string']);
        }
        if (Auth::attempt($request->all('login', 'password'))) {
           return json_encode(['key'=>Auth::user()->key]);
        }
        return Response(json_encode(['message' => 'Не удалось авторизоваться, проверьте правильность заполнения полей']), $status = 404, ['Content-Type' => 'string']);

    }
}
