<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlhalgaTable extends Migration {

	public function up()
	{
		Schema::create('alhalga', function(Blueprint $table) {
			$table->id();
			$table->string('name', 100);
			$table->integer('id_teacher')->unsigned();
			$table->integer('id_teacher_two')->unsigned();
			$table->string('name_teacher_one', 100);
			$table->string('name_teacher_two', 100);
			$table->integer('number_student');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('alhalga');
	}
}