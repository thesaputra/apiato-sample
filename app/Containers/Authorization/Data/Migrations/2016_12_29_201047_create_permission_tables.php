<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionTables extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    $tableNames = config('permission.table_names');

    Schema::create($tableNames['permissions'], function (Blueprint $table) {
      $table->uuid('id');
      $table->string('name');
      $table->string('guard_name');
      $table->string('display_name')->nullable();
      $table->string('description')->nullable();
      $table->uuid('created_by')->nullable();
      $table->uuid('updated_by')->nullable();
      $table->timestamps();
    });

    Schema::create($tableNames['roles'], function (Blueprint $table) {
      $table->uuid('id');
      $table->string('name');
      $table->string('guard_name');
      $table->string('display_name')->nullable();
      $table->string('description')->nullable();
      $table->uuid('created_by')->nullable();
      $table->uuid('updated_by')->nullable();
      $table->timestamps();
    });

    Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames) {
      $table->uuid('permission_id');
      $table->string('model_type')->nullable();
      $table->uuid('model_id');
    });

    Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames) {
      $table->uuid('role_id');
      $table->string('model_type')->nullable();
      $table->uuid('model_id');
    });

    Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
      $table->uuid('permission_id');
      $table->uuid('role_id');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    $tableNames = config('permission.table_names');

    Schema::drop($tableNames['role_has_permissions']);
    Schema::drop($tableNames['model_has_roles']);
    Schema::drop($tableNames['model_has_permissions']);
    Schema::drop($tableNames['roles']);
    Schema::drop($tableNames['permissions']);
  }
}
