<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('class_id')->unsigned();
            $table->integer('user_id')->nullable();
            $table->date('lesson_date')->nullable();
            $table->time('lesson_start_time')->nullable();
            $table->time('lesson_end_time')->nullable();
            $table->string('unit')->nullable();
            $table->string('lesson_title')->nullable();
            $table->text('lesson_text')->nullable();
            $table->text('homework')->nullable();
            $table->text('notes')->nullable();
            $table->text('standards')->nullable();
            $table->text('objective')->nullable();
            $table->text('differentiation')->nullable();
            $table->text('instructional')->nullable();
            $table->text('materials')->nullable();
            $table->text('direct')->nullable();
            $table->text('guided')->nullable();
            $table->text('independent')->nullable();
            $table->text('attachments')->nullable();
            $table->integer('lock_lesson_to_date')->default('0');
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

        Schema::dropIfExists('class_lessons');

    }
}
