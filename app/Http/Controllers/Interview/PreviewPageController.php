<?php
declare(strict_types=1);

namespace App\Http\Controllers\Interview;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\Profession;
use App\Models\CatQuestCount;

class PreviewPageController extends Controller
{
    public function getPreviewPage( int $id):Response|string
    {
        if (is_numeric($id) and $id > 0) {

            $profession = Profession::getProfById((int)$id);
            if (count($profession) != 0) {
                $profession = json_decode(json_encode($profession[0]));
                $profession->count = CatQuestCount::getSumCountQuestsForProf((int)$id);
                return json_encode($profession);
            }

            return Response(json_encode(['message' => 'Профессия не найдена']), $status = 404, ['Content-Type' => 'string']);

        }
        return Response(json_encode(['message' => 'Профессия не найдена']), $status = 404, ['Content-Type' => 'string']);

    }
}
