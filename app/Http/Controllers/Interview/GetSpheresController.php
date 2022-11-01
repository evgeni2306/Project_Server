<?php
declare(strict_types=1);

namespace App\Http\Controllers\Interview;

use App\Http\Controllers\Controller;
use App\Models\Sphere;
use Illuminate\Http\Response;

class GetSpheresController extends Controller
{
    public function getSpheresForInterview(): string|Response
    {
        $spheres = Sphere::all('name', 'id');
        if (count($spheres)) {
            return Response(json_encode(['message' => 'Никаких сфер на найдено']), $status = 404, ['Content-Type' => 'string']);
        }
        $spheres = json_encode($spheres);
        return $spheres;
    }
}
