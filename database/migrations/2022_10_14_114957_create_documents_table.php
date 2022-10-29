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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['masuk', 'keluar']);
            $table->string('letter_number');
            $table->date('letter_date');
            $table->date('date_received')->nullable();
            $table->foreignId('sender_id');
            $table->string('sender_name');
            $table->foreignId('receiver_id');
            $table->string('receiver_name');
            $table->text('regarding');
            $table->string('file');
            $table->string('viewer');
            $table->string('sender_email')->nullable();
            $table->string('receiver_email')->nullable();
            $table->tinyInteger('disposisi_set')->default(0);
            $table->text('disposisi')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('documents');
    }
};
