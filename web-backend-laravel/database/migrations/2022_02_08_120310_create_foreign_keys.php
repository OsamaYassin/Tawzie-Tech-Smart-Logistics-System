<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('alhalga', function(Blueprint $table) {
			$table->foreign('id_teacher')->references('id')->on('teacher')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('alhalga', function(Blueprint $table) {
			$table->foreign('id_teacher_two')->references('id')->on('teacher')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('teacher', function(Blueprint $table) {
			$table->foreign('id_halga')->references('id')->on('alhalga')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('alhalga', function(Blueprint $table) {
			$table->dropForeign('alhalga_id_teacher_foreign');
		});
		Schema::table('alhalga', function(Blueprint $table) {
			$table->dropForeign('alhalga_id_teacher_two_foreign');
		});
		Schema::table('teacher', function(Blueprint $table) {
			$table->dropForeign('teacher_id_halga_foreign');
		});
	}
}