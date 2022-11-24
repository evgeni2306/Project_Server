<?php
declare(strict_types=1);

namespace App\Http\Controllers\Interview;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AnswerTaskController extends Controller
{
    public function answerTask(Request $request): Response|int
    {
        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
            'taskId' => 'required|integer|exists:tasks,id',
            'answer' => 'required|bool'
        ]);
        if ($validator->fails()) {
            return Response(json_encode(['message' => 'Что-то пошло не так']), $status = 404, ['Content-Type' => 'string']);
        }
        $data = $validator->getData();
        $task = Task::answerTask((int)$data['taskId'], (bool)$data['answer']);
        if ($task != null) {
            return 1;
        }
        return Response(json_encode(['message' => 'Что-то пошло не так']), $status = 501, ['Content-Type' => 'string']);

    }

}
