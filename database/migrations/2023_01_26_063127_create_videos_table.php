<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index()->nullable($value = true)->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('category_id')->index()->nullable($value = true)->unsigned();
            $table->foreign('category_id')->references('id')->on('video_categories')->onDelete('cascade');
            $table->string('title')->nullable($value = false);
            $table->string('description')->nullable($value = false);
            $table->bigInteger('views')->default(0)->nullable($value = false);
            $table->string('disk')->nullable($value = false);
            $table->string('path')->nullable($value = false);
            $table->string('image_path')->nullable($value = false);
            $table->datetime('converted_for_downloading_at')->nullable($value = true);
            $table->datetime('converted_for_streaming_at')->nullable($value = true);
            $table->timestamp('created_at')->nullable($value = false)->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->boolean('video_status')->default(1)->nullable($value = false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
};
