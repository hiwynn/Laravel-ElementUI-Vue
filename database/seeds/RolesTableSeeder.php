<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('roles')->insert(
			[
				'id'          => 1,
				'title'       => '超级管理员',
				'canAdd'      => 1,
				'canDelete'   => 1,
				'canUpdate'   => 1,
				'canRetrieve' => 1
			]
		);
		DB::table('roles')->insert(
			[
				'id'          => 2,
				'title'       => '管理员',
				'canAdd'      => 1,
				'canDelete'   => 1,
				'canUpdate'   => 1,
				'canRetrieve' => 1
			]
		);
		DB::table('roles')->insert(
			[
				'id'          => 3,
				'title'       => '用户',
				'canAdd'      => 0,
				'canDelete'   => 0,
				'canUpdate'   => 0,
				'canRetrieve' => 1
			]
		);
	}
}
