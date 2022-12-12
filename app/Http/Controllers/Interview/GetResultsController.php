<?php
declare(strict_types=1);

namespace App\Http\Controllers\Interview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Interview;

class GetResultsController extends Controller
{
    public function getResults(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
            'interviewId' => 'required|integer|exists:interviews,id'
        ]);
        if ($validator->fails()) {
            return Response(json_encode(['message' => 'Запрос не проходит валидацию']), $status = 404, ['Content-Type' => 'string']);
        }
        $data = $validator->getData();
        $result = Interview::getInterviewResults((int)$data["interviewId"]);
        return json_encode($result);
    }
}
