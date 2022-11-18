<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    const TABLE_NAME = 'interview_templates';

    public function up():void
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('profession_id')->constrained('professions');
            $table->unique(['user_id', 'profession_id']);
            $table->timestamps();
        });
    }
    public function down():void
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
};
