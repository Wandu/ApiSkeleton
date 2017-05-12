<?php

use Wandu\Database\Contracts\ConnectionInterface;
use Wandu\Database\Migrator\Migration;
use Wandu\Database\Query\CreateQuery;
use Wandu\Database\Query\Expression\RawExpression;

class CreateUsers extends Migration 
{
    /**
     * {@inheritdoc}
     */
    public function migrate(ConnectionInterface $connection)
    {
        $connection->query($connection->createQueryBuilder('users')->create(function (CreateQuery $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
            $table->varchar("username", 20)->unique();
            $table->varchar('password', 255)->nullable();
            $table->set("roles")->nullable();
            $table->json('permissions')->nullable();
            $table->timestamp('created_at')->default(new RawExpression('CURRENT_TIMESTAMP'));
            $table->addColumn(new RawExpression('`updated_at` TIMESTAMP DEFAULT now() ON UPDATE now()'));

            $table->primaryKey('id');
        }));
    }

    /**
     * {@inheritdoc}
     */
    public function rollback(ConnectionInterface $connection)
    {
        $connection->query($connection->createQueryBuilder('users')->drop());
    }
}
