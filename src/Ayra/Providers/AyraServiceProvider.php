<?php

namespace Ayra\Providers;

use Ayra\Console\AyraCommand;
use Ayra\Console\InstallCommand;
use Ayra\Generators\MigrationGenerator;
use Ayra\Generators\ModelGenerator;
use Illuminate\Support\ServiceProvider;

class AyraServiceProvider extends ServiceProvider
{
    /**
   * Ayra version.
   *
   * @var string
   */
  const VERSION = '1.1.1';

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register()
  {
      $this->registerCommands();
  }

  /**
   * Register the commands.
   *
   * @return void
   */
  public function registerCommands()
  {
      $this->registerAyraCommand();
      $this->registerInstallCommand();

    // Resolve the commands with Artisan by attaching the event listener to Artisan's
    // startup. This allows us to use the commands from our terminal.
    $this->commands('command.Ayra', 'command.Ayra.install');
  }

  /**
   * Register the 'Ayra' command.
   *
   * @return void
   */
  protected function registerAyraCommand()
  {
      $this->app->singleton('command.Ayra', function ($app) {
          return new AyraCommand();
      });
  }

  /**
   * Register the 'Ayra:install' command.
   *
   * @return void
   */
  protected function registerInstallCommand()
  {
      $this->app->singleton('command.Ayra.install', function ($app) {
          $migrator = new MigrationGenerator($app['files']);
          $modeler = new ModelGenerator($app['files']);

          return new InstallCommand($migrator, $modeler);
      });
  }

  /**
   * Get the services provided by the provider.
   *
   * @return array
   */
  public function provides()
  {
      return ['command.Ayra', 'command.Ayra.install'];
  }
}
