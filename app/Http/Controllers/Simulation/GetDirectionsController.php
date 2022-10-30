<?php
declare(strict_types=1);

namespace App\Http\Controllers\Simulation;

use App\Http\Controllers\Controller;
use App\Models\Direction;

class GetDirectionsController extends Controller
{
    public function getDirectionsForSimulation($id)
    {

        if (is_numeric($id) and $id > 0) {
            $directions = Direction::getDirBySphereId((int)$id);
            $directions = json_encode($directions);
            dd($directions);
        }
        return 'ошибка';
    }

}
