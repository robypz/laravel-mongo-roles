<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use MongoDB\Laravel\Schema\Blueprint;

return new class extends Migration {

    public function up()
    {
        Schema::create('roles', function (Blueprint $collection) {
            $collection->string('name');
        });
        Schema::create('permissions', function (Blueprint $collection) {
            $collection->string('permission');
        });
    }
    public function down()
    {
        Schema::drop('roles');
        Schema::drop('permissions');
    }
};
