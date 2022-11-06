<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Direction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    static function getDirBySphereId(int $id)
    {
        $directions = self::where('sphere_id', $id)->select('id', 'name')->get();
        foreach ($directions as $dir) {
            $dir->id = (int)$dir->id;
        }
        return $directions;
    }
}
