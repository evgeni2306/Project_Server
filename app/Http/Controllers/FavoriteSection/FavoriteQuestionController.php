<?php
declare(strict_types=1);

namespace App\Http\Controllers\FavoriteSection;

use App\Models\FavoriteQuestion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class FavoriteQuestionController extends Controller
{
    public function addFavorite(Request $request): int|Response
    {
        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
            'questionId' => 'required|integer|exists:questions,id',
        ]);
        if ($validator->fails()) {
            return Response(json_encode(['message' => 'Запрос не проходит валидацию']), $status = 404, ['Content-Type' => 'string']);
        }
        $data = $validator->getData();
        $userId = User::getIdByKey($data['authKey']);
        try {
            $favoriteQuestion = FavoriteQuestion::create(['user_id' => $userId, 'question_id' => $data['questionId']]);
            return $favoriteQuestion->id;
        } catch (\Exception $exp) {
            return Response(json_encode(['message' => 'Что-то пошло не так']), $status = 404, ['Content-Type' => 'string']);
        }
    }

    public function deleteFavorite(Request $request): int|Response
    {
        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
            'favoriteId' => 'required|integer|exists:favorite_questions,id',
        ]);
        if ($validator->fails()) {
            return Response(json_encode(['message' => 'Запрос не проходит валидацию']), $status = 404, ['Content-Type' => 'string']);
        }
        $data = $validator->getData();
        if (FavoriteQuestion::destroy($data['favoriteId'])) {
            return 1;
        }
        return Response(json_encode(['message' => 'Что-то пошло не так']), $status = 404, ['Content-Type' => 'string']);

    }
}
