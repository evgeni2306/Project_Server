<?php

declare(strict_types=1);

namespace App\Http\Controllers\Interview;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use Illuminate\Http\Response;

class GetProfessionsController extends Controller
{
    public function getProfessionsForInterview( int $id): string|Response
    {

        if (is_numeric($id) and $id > 0) {
            $professions = Profession::getProfByTechnologyId((int)$id);
            if (count($professions) == 0) {
                return Response(json_encode(['message' => 'Профессий по этой технологии не найдено']), $status = 404, ['Content-Type' => 'string']);
            }
            $professions = json_encode($professions);
            return $professions;
        }
        return Response(json_encode(['message' => 'Профессия не найдена']), $status = 404, ['Content-Type' => 'string']);

    }
}
