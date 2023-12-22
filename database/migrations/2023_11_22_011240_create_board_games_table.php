<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_games', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('long_description')->nullable();
            $table->text('rules')->nullable();
            $table->string('image')->nullable();
            $table->integer('min_players')->nullable();
            $table->integer('max_players')->nullable();
            $table->integer('min_playtime')->nullable();
            $table->integer('max_playtime')->nullable();
            $table->integer('year_published')->nullable();
            $table->string('designer')->nullable();
            $table->string('publisher')->nullable();
            $table->decimal('average_rating', 3, 2)->nullable();
            $table->integer('difficulty_level')->nullable();
            $table->string('game_type')->nullable();
            $table->string('mechanics')->nullable();
            $table->boolean('is_expansion')->default(false);
            $table->date('release_date')->nullable();
            $table->string('language_dependency')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board_games');
    }
}
