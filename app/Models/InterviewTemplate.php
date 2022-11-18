<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profession_id'
    ];

    static function createTemplate(int $interviewId):void
    {
        $data = Interview::select('user_id', 'profession_id')->where('id', $interviewId)->first();
        self::create(['user_id' => $data->user_id, 'profession_id' => $data->profession_id]);
    }
}
