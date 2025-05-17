<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->id();
            $table->string('greeting');
            $table->string('name');
            $table->json('role'); // JSON array of roles
            $table->string('button_text');
            $table->text('bio');
            $table->string('gpa')->nullable();
            $table->string('degree')->nullable();
            $table->string('institution')->nullable();
            $table->string('duration')->nullable();
            $table->string('background_image')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('about_image')->nullable();
            $table->string('resume')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('personal_infos');
    }
};
