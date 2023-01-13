<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profession_id',
        'status'
    ];

    protected $attributes = [
        'status' => null,
    ];

    static function getInterviewResults(int $interviewId): \stdClass
    {
        $countRight = Task::query()->where('interview_id', $interviewId)->where('status', '=', 1)->count();
        $countWrong = Task::query()->where('interview_id', $interviewId)->where('status', '=', 0)->count();
        $wrongQuestions = Task::query()->join('questions', 'question_id', '=', 'questions.id')
            ->join('categories', 'questions.category_id', '=', 'categories.id')
            ->select('questions.id as questionId', 'questions.question', 'answer', 'categories.name as category')
            ->where('interview_id', '=', $interviewId)
            ->where('status', '=', 0)
            ->get();
        return (object)array('countRight' => $countRight, 'countWrong' => $countWrong, 'wrongQuestions' => $wrongQuestions);

    }

    static function changeInterviewStatus(int $interviewId): void
    {
        self::query()->where('id', '=', $interviewId)
            ->update(['status' => 1]);
    }
}
