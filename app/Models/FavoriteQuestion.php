<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question_id',
    ];

    static function checkFavorite(Task $task, int $userId):Task
    {
        $favorite = self::where('question_id', '=', $task->questionId)
            ->where('user_id', '=', $userId)->first();

        if ($favorite != null) {
            $task->isFavorite = 1;
            $task->favoriteId = $favorite->id;
            return $task;
        }
        $task->isFavorite = 0;
        $task->favoriteId = 0;
        return $task;
    }
}
