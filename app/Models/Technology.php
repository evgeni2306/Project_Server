<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'creator_id',
        'direction_id'
    ];

    static function getTechByDirectionId(int $id): Collection
    {
        return self::where('direction_id', '=', $id)->select('id', 'name')->get();
    }
}
