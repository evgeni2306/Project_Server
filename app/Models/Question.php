<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'answer',
        'question',
        'creator_id'
    ];

    static function getQuestionsByProfId(int $id): Collection
    {
        $questions = self::join('cat_quest_counts', 'questions.category_id', '=', 'cat_quest_counts.category_id')
            ->join('professions', 'profession_id', '=', 'professions.id')
            ->join('categories', 'categories.id', '=', 'questions.category_id')
            ->select('questions.id', 'questions.question','categories.name')
            ->where('professions.id', '=', $id)
            ->get();
        return $questions;
    }
}
