<?php
declare(strict_types=1);

namespace App\Http\Controllers\Interview;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Interview;
use Illuminate\Support\Facades\Validator;

class InterviewStartController extends Controller
{
    public function startInterview(Request $request):Response
    {

        $validator = Validator::make($request->all(), [
            'key' => 'required|string|max:255|exists:users,key',
            'id' => 'required|integer|exists:professions,id'
        ]);

        if ($validator->fails()) {
            return Response(json_encode(['message' => 'Что-то пошло не так']), $status = 404, ['Content-Type' => 'string']);
        }
        $userId = User::getIdByKey($request->all('key'));

        Interview::create(['user_id' => $userId, 'profession_id' => (int)$request->all('id')]);
        return 5555;


    }
}
