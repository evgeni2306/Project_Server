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

    static function checkFavorite(Task|Question $question, int $userId): Task|Question
    {
        $favorite = self::where('question_id', '=', $question->questionId)
            ->where('user_id', '=', $userId)->first();

        if ($favorite != null) {
            $question->isFavorite = 1;
            $question->favoriteId = $favorite->id;
            return $question;
        }
        $question->isFavorite = 0;
        $question->favoriteId = 0;
        return $question;
    }
}
