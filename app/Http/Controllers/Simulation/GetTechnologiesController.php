<?php

declare(strict_types=1);

namespace App\Http\Controllers\Simulation;

use App\Http\Controllers\Controller;
use App\Models\Technology;

class GetTechnologiesController extends Controller
{
    public function getTechnologiesForSimulation($id)
    {

        if (is_numeric($id) and $id > 0) {
            $technologies = Technology::getTechByDirectionId((int)$id);
            $technologies = json_encode($technologies);
            dd($technologies);
        }
        return 'ошибка';
    }
}
