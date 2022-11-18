<?php
declare(strict_types=1);

namespace App\Http\Controllers\Interview;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Interview;
use Illuminate\Support\Facades\Validator;

class InterviewStartController extends Controller
{
    public function startInterview(Request $request): int|Response
    {

        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
            'profId' => 'required|integer|exists:professions,id'
        ]);

        if ($validator->fails()) {
            return Response(json_encode(['message' => 'Что-то пошло не так']), $status = 404, ['Content-Type' => 'string']);
        }
        $data = $validator->getData();
        $userId = User::getIdByKey($data['authKey']);
        $profId = (int)$data['profId'];
        $interview = Interview::create(['user_id' => $userId, 'profession_id' => $profId]);

        Task::createTasksForInterview($profId, $interview->id);

        return $interview->id;
    }
}
