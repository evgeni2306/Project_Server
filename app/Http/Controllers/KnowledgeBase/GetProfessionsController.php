<?php
declare(strict_types=1);

namespace App\Http\Controllers\KnowledgeBase;

use App\Models\Profession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class GetProfessionsController extends Controller
{
    public function getProfessionsForKnowledgeBase(Request $request): string|Response
    {
        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
        ]);

        if ($validator->fails()) {
            return Response(json_encode(['message' => 'Запрос не проходит валидацию']), $status = 404, ['Content-Type' => 'string']);
        }
        $professions = Profession::all('id', 'name');

        return json_encode($professions);

    }
}
