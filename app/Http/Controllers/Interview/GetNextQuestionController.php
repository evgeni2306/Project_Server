<?php
declare(strict_types=1);

namespace App\Http\Controllers\Interview;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\InterviewTemplate;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class GetNextQuestionController extends Controller
{
    public function getNextQuestion(Request $request): string|Response|int
    {
        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
            'interviewId' => 'required|integer|exists:interviews,id'
        ]);
        if ($validator->fails()) {
            return Response(json_encode(['message' => 'Что-то пошло не так']), $status = 404, ['Content-Type' => 'string']);
        }
        $interviewId = (int)$validator->getData()['interviewId'];
        $task = Task::getQuestion($interviewId);
        if ($task == null) {
            Interview::changeInterviewStatus($interviewId);
            InterviewTemplate::createTemplate($interviewId);
            return Response(json_encode(['message' => 'Нет вопросов']), $status = 204, ['Content-Type' => 'string']);

        }
        return json_encode($task);
    }
}
