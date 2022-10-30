<?php
declare(strict_types=1);

namespace App\Http\Controllers\Simulation;

use App\Http\Controllers\Controller;
use App\Models\Sphere;

class GetSpheresController extends Controller
{
    public function getSpheresForSimulation()
    {
        $spheres = Sphere::all('name', 'id');
        $spheres = json_encode($spheres);
        dd(json_decode($spheres));
    }
}
