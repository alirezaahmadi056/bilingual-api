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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("image");
            $table->text("description");
            $table->integer("price");
            $table->text("spot_id");
            $table->integer("percent");
            $table->integer("hour");
            $table->timestamps();
        });

        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->integer("count_video");
            $table->unsignedBigInteger("course_id");
            $table->foreign('course_id')->references('id')->on('courses')->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
        Schema::dropIfExists('seasons');
    }
};
