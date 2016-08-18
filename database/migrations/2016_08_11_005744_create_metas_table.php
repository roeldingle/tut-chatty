<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('metas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key',60);
            $table->string('label',60);
            $table->string('type',60);
        });

		/*create meta user pivot*/
        Schema::create('meta_user', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('meta_id')->unsigned()->index();
            $table->foreign('meta_id')->references('id')->on('metas')->onDelete('cascade');
            $table->string('value');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('metas');
		Schema::drop('meta_user');
	}

}
