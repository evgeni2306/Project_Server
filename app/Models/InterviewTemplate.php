<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profession_id'
    ];

    static function createTemplate(int $interviewId): void
    {
        $data = Interview::select('user_id', 'profession_id')->where('id', '=', $interviewId)->first();
        $check = self::where('user_id', '=', $data->user_id)->where('profession_id', '=', $data->profession_id)->first();
        if ($check == null) {
            self::create(['user_id' => $data->user_id, 'profession_id' => $data->profession_id]);
        }

    }

    static function getTemplates(int $userId): Collection
    {
        $templates = self::join('professions', 'profession_id', '=', 'professions.id')
            ->select('interview_templates.id', 'professions.name')
            ->where('user_id', '=', $userId)
            ->get();
        return $templates;
    }
}
