<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatQuestCount extends Model
{
    use HasFactory;

    protected $fillable = [
        'count',
        'profession_id',
        'category_id'

    ];

    static function getSumCountQuestsForProf(int $id): int
    {
        return (int)self::where('profession_id', $id)->sum('count');
    }

    static function getCountQuestsForProf(int $id)
    {
        return self::select('category_id', 'count')->where('profession_id', $id)->get();
    }
}
