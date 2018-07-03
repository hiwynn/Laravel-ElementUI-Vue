<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(
			'roles',
			function (Blueprint $table) {
				$table->increments('id');
				$table->smallInteger('canAdd');
				$table->smallInteger('canDelete');
				$table->smallInteger('canUpdate');
				$table->smallInteger('canRetrieve');
				$table->timestamps();
			}
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('roles');
	}
}
