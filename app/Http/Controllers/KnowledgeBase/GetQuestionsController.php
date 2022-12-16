<?php
declare(strict_types=1);

namespace App\Http\Controllers\KnowledgeBase;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class GetQuestionsController extends Controller
{
    public function getQuestionsForKnowledgeBase(Request $request):string|Response
    {
        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
            'profId' => 'required|integer|exists:professions,id',
        ]);
        if ($validator->fails()) {
            return Response(json_encode(['message' => 'Запрос не проходит валидацию']), $status = 404, ['Content-Type' => 'string']);
        }
        $profId = (int)$validator->getData()['profId'];
        $questions = Question::getQuestionsByProfId($profId);
        return json_encode($questions);

    }
}
