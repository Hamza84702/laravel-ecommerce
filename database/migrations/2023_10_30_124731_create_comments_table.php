<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->longText('comment')->nullable();
            $table->string('user_id')->nullable();
            $table->unsignedBigInteger('reply_id')->nullable();
            $table->timestamps();

            $table->foreign('reply_id')
            ->references('id')->on('replies') // Assuming your comments table is named 'comments'
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
        Schema::dropIfExists('comments');
    }
}
