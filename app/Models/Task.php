<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'interview_id',
        'status'
    ];
    protected $attributes = [
        'status' => null,
    ];

    static function getQuestion(int $interviewId): Task|null
    {
        $task = Task::join('questions', 'question_id', '=', 'questions.id')
            ->join('categories', 'questions.category_id', '=', 'categories.id')
            ->select('tasks.id as taskId', 'questions.question', 'answer', 'categories.name as category', 'question_id as questionId')
            ->where('interview_id', '=', $interviewId)
            ->where('status', '=', null)
            ->first();
        return $task;
    }

    static function createTasksForInterview(int $id, int $interviewId): void
    {
        $catQuestCount = CatQuestCount::select('category_id', 'count')->where('profession_id', $id)->get();
        foreach ($catQuestCount as $var) {
            $question = Question::select('id as question_id')->inRandomOrder()->where('category_id', $var->category_id)->get();
            foreach ($question as $var1) {
                $var1->interview_id = $interviewId;
                $var1 = json_decode(json_encode($var1), true);
                self::create($var1);

            }
        }
    }

    static function answerTask(int $taskId, bool $answer)
    {
        $task = self::find($taskId);
        if($task->status==null){
            $task->status = $answer;
            $task->save();
            return true;
        }
        return false;
    }
}
