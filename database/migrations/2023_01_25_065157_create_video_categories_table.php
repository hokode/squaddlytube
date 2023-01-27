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
        Schema::create('video_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category')->nullable($value = false);
            $table->timestamp('created_at')->nullable($value = false)->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->boolean('category_status')->default(1)->nullable($value = false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_categories');
    }
};
