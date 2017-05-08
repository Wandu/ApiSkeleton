<?php
namespace Wandu\Api\Console\Commands;

use Wandu\Database\Migrator\Commands\MigrateCommand;
use Wandu\Database\Migrator\Commands\MigrateCreateCommand;
use Wandu\Database\Migrator\Commands\MigrateDownCommand;
use Wandu\Database\Migrator\Commands\MigrateRollbackCommand;
use Wandu\Database\Migrator\Commands\MigrateStatusCommand;
use Wandu\Database\Migrator\Commands\MigrateUpCommand;

return [
    'migrate' => MigrateCommand::class,
    'migrate:rollback' => MigrateRollbackCommand::class,
    'migrate:create' => MigrateCreateCommand::class,
    'migrate:up' => MigrateUpCommand::class,
    'migrate:down' => MigrateDownCommand::class,
    'migrate:status' => MigrateStatusCommand::class,
];
