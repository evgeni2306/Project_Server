<?php
declare(strict_types=1);

namespace App\Http\Controllers\Interview;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class GetNextQuestionController extends Controller
{
    public function getNextQuestion(Request $request):string|Response|int
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required|string|max:255|exists:users,key',
            'interviewId' => 'required|integer|exists:interviews,id'
        ]);

        if ($validator->fails()) {
            return Response(json_encode(['message' => 'Что-то пошло не так']), $status = 404, ['Content-Type' => 'string']);
        }
        $data = $validator->getData();
        $task = Task::getQuestion((int)$data['interviewId']);
        if ($task == null) {
            return 0;
        }
        return json_encode($task);
    }
}
