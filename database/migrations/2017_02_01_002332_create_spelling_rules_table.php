<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpellingRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spelling_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 3); // p for prefix, s for suffix, r for replace
            $table->string('key', 2);
            $table->string('value');
            $table->string('contain')->nullable();
            $table->string('raw');
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
        Schema::dropIfExists('spelling_rules');
    }
}
