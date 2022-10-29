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
        Schema::create('frontends', function (Blueprint $table) {
            $table->id();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('picture1')->nullable();
            $table->string('title1')->nullable();
            $table->string('subtitle1')->nullable();
            $table->text('body1')->nullable();
            $table->string('picture2')->nullable();
            $table->string('title2')->nullable();
            $table->string('subtitle2')->nullable();
            $table->text('body2')->nullable();
            $table->string('wanumber')->nullable();
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
        Schema::dropIfExists('frontends');
    }
};
