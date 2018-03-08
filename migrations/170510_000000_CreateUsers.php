<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Wandu\Service\Eloquent\Migration;

class CreateUsers extends Migration
{
    /**
     * @param \Illuminate\Database\Schema\Builder $schema
     */
    public function migrate(Builder $schema)
    {
        $schema->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 100)->unique();
            $table->string('password', 100);
            $table->string('name', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * @param \Illuminate\Database\Schema\Builder $schema
     */
    public function rollback(Builder $schema)
    {
        $schema->dropIfExists('users');
    }
}
