<?php
declare(strict_types=1);

namespace App\Http\Controllers\Interview;

use App\Http\Controllers\Controller;
use App\Models\InterviewTemplate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class InterviewTemplateController extends Controller
{
    public function getTemplateList(Request $request): Response|string
    {
        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
        ]);
        if ($validator->fails()) {
            return Response(json_encode(['message' => 'Что-то пошло не так']), $status = 404, ['Content-Type' => 'string']);
        }
        $data = $validator->getData();
        $userId = User::getIdByKey($data['authKey']);
        $templates = InterviewTemplate::getTemplates($userId);
        return json_encode($templates);
    }

    public function deleteTemplate(Request $request): int|Response
    {
        $validator = Validator::make($request->all(), [
            'authKey' => 'required|string|max:255|exists:users,key',
            'templateId' => 'required|string|max:255|exists:interview_templates,id',
        ]);
        if ($validator->fails()) {
            return Response(json_encode(['message' => 'Что-то пошло не так']), $status = 404, ['Content-Type' => 'string']);
        }
        $templateId = $validator->getData()['templateId'];
        InterviewTemplate::destroy($templateId);
        return 1;
    }
}
