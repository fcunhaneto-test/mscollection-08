<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->unsignedInteger('id', 1);
            $table->unsignedInteger('season_id');
            $table->unsignedTinyInteger('episode');
            $table->string('title');
            $table->string('original_title')->nullable();
            $table->text('summary')->nullable();
            $table->timestamps();

            $table->unique(['season_id', 'episode']);
            $table->foreign('season_id')->on('seasons')->references('id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodes');
    }
}
