<?php
namespace App\Console;

use Wandu\Config\Contracts\Config;
use Wandu\Config\Exception\CannotLoadException;
use Wandu\Console\Commands\PsyshCommand;
use Wandu\Console\Contracts\CommandAttachable;
use Wandu\Foundation\ConsoleApp\Bootstrap;
use Wandu\Migrator\Commands as Migrator;
use Wandu\Migrator\MigratorServiceProvider;

class ConsoleAppBootstrap extends Bootstrap
{
    /**
     * {@inheritdoc}
     */
    public function providers(): array
    {
        $providers = parent::providers();
        $providers = array_merge($providers, require __DIR__ . '/../../providers.php');
        $providers[] = new MigratorServiceProvider();
        return $providers;
    }

    /**
     * {@inheritdoc}
     */
    public function registerConfiguration(Config $config)
    {
        $config->load(__DIR__ . '/../../config');
        try {
            $config->load(__DIR__ . '/../../env.yml');
        } catch (CannotLoadException $e) {
        }
    }

    /**
     * {@inheritdoc}
     */
    public function registerCommands(CommandAttachable $manager)
    {
        $manager->attach('sh', PsyshCommand::class);

        $manager->attach('migrator:status', Migrator\StatusCommand::class);
        $manager->attach('migrator:create', Migrator\CreateCommand::class);
        $manager->attach('migrator:migrate', Migrator\MigrateCommand::class);
        $manager->attach('migrator:rollback', Migrator\RollbackCommand::class);
        $manager->attach('migrator:up', Migrator\UpCommand::class);
        $manager->attach('migrator:down', Migrator\DownCommand::class);
    }
}
