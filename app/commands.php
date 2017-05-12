<?php
namespace Wandu\Api\Console\Commands;

use Wandu\Database\Commands\MigrateCommand;
use Wandu\Database\Commands\MigrateCreateCommand;
use Wandu\Database\Commands\MigrateDownCommand;
use Wandu\Database\Commands\MigrateRollbackCommand;
use Wandu\Database\Commands\MigrateStatusCommand;
use Wandu\Database\Commands\MigrateUpCommand;

return [
    'migrate' => MigrateCommand::class,
    'migrate:rollback' => MigrateRollbackCommand::class,
    'migrate:create' => MigrateCreateCommand::class,
    'migrate:up' => MigrateUpCommand::class,
    'migrate:down' => MigrateDownCommand::class,
    'migrate:status' => MigrateStatusCommand::class,
];
