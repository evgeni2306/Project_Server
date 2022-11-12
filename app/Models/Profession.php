<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'creator_id',
        'technology_id'
    ];
    static function getProfByTechnologyId(int $id): Collection
    {
        return self::where('technology_id', $id)->select('id', 'name')->get();
    }

    static function getProfById(int $id): Collection
    {
        return self::where('id', $id)->select('id', 'name')->get();
    }

}
