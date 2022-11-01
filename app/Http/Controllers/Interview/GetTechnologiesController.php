<?php

declare(strict_types=1);

namespace App\Http\Controllers\Interview;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Response;

class GetTechnologiesController extends Controller
{
    public function getTechnologiesForInterview($id): string|Response
    {

        if (is_numeric($id) and $id > 0) {
            $technologies = Technology::getTechByDirectionId((int)$id);
            if (count($technologies) == 0) {
                return Response(json_encode(['message' => 'Технологий в этой сфере не найдено']), $status = 404, ['Content-Type' => 'string']);
            }
            $technologies = json_encode($technologies);
            return $technologies;
        }
        return Response(json_encode(['message' => 'Технология не найдена']), $status = 404, ['Content-Type' => 'string']);

    }
}
