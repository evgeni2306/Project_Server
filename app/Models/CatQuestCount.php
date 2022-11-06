<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatQuestCount extends Model
{
    use HasFactory;

    static function getCountQuests(int $id): int
    {
        return (int)self::where('profession_id', $id)->sum('count');
    }
}
