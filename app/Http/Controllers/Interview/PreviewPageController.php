<?php
declare(strict_types=1);

namespace App\Http\Controllers\Interview;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\Profession;
use App\Models\CatQuestCount;

class PreviewPageController extends Controller
{
    public function getPreviewPage(int $profId): Response|string
    {
        if (is_numeric($profId) and $profId > 0) {

            $profession = Profession::getProfById((int)$profId);
            if (count($profession) != 0) {
                $profession = json_decode(json_encode($profession[0]));
                $profession->count = CatQuestCount::getSumCountQuestsForProf((int)$profId);
                return json_encode($profession);
            }

            return Response(json_encode(['message' => 'Профессия не найдена']), $status = 404, ['Content-Type' => 'string']);

        }
        return Response(json_encode(['message' => 'Профессия не найдена']), $status = 404, ['Content-Type' => 'string']);

    }
}
