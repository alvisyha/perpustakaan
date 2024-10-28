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
        Schema::create('loans_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('book_id')->unsigned();
            $table->string('book_title');
            $table->bigInteger('loan_id')->unsigned();
            $table->integer('quantity');
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');
            $table->index('student_id');
            $table->index('book_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans_items');
    }
};
