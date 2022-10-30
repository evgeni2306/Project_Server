<?php

declare(strict_types=1);

namespace App\Http\Controllers\Simulation;

use App\Http\Controllers\Controller;
use App\Models\Profession;

class GetProfessionsController extends Controller
{
    public function getProfessionsForSimulation($id)
    {

        if (is_numeric($id) and $id > 0) {
            $professions = Profession::getProfByTechnologyId((int)$id);
            $professions = json_encode($professions);
            dd(json_decode($professions));
        }
        return 'ошибка';
    }
}
