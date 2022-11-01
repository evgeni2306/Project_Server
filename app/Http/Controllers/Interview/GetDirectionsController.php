<?php
declare(strict_types=1);

namespace App\Http\Controllers\Interview;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use Illuminate\Http\Response;

class GetDirectionsController extends Controller
{
    public function getDirectionsForInterview($id): string|Response
    {

        if (is_numeric($id) and $id > 0) {
            $directions = Direction::getDirBySphereId((int)$id);
            if (count($directions) == 0) {
                return Response(json_encode(['message' => 'Направлений по этой сфере не найдено']), $status = 404, ['Content-Type' => 'string']);
            }
            $directions = json_encode($directions);
            return $directions;
        }
        return Response(json_encode(['message' => 'Направление не найдено']), $status = 404, ['Content-Type' => 'string']);
    }

}
