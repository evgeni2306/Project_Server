<?php
declare(strict_types=1);

namespace App\Http\Controllers\Interview;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AnswerTaskController extends Controller
{
    public function answerTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
            'interviewId' => 'required|integer|exists:interviews,id',
            'taskId'=>'required|integer|exists:tasks,id'
        ]);
    }

}
