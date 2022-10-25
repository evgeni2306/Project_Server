<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    const TABLE_NAME = "users";

    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(false);
            $table->string('surname', 255)->nullable(false);
            $table->string('login', 255)->nullable(false)->unique();
            $table->string('key', 255)->nullable(false)->unique();
            $table->string('password', 255)->nullable(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
};
