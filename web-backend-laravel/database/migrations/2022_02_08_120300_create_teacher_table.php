<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeacherTable extends Migration {

	public function up()
	{
		Schema::create('teacher', function(Blueprint $table) {
			$table->id();
			$table->string('name', 100);
			$table->string('phone', 100);
			$table->string('address', 100);
			$table->integer('id_halga')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('teacher');
	}
}