<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $permissions = [
      'permission-list',
      'permission-create',
      'permission-edit',
      'permission-delete',
      'role-list',
      'role-create',
      'role-edit',
      'role-delete',
      'material-list',
      'material-create',
      'material-edit',
      'material-delete',
      'user-list',
      'user-create',
      'user-edit',
      'user-delete',
    ];

    foreach ($permissions as $permission) {
      Permission::create(['name' => $permission]);
    }
  }
}
