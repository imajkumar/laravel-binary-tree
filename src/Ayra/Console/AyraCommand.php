<?php

namespace Ayra\Console;

use Ayra\Providers\AyraServiceProvider as Ayra;
use Illuminate\Console\Command;

class AyraCommand extends Command
{
    /**
   * The console command name.
   *
   * @var string
   */
  protected $name = 'Ayra';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Get Ayra version notice.';

  /**
   * Execute the console command.
   *
   * @return void
   */
  public function fire()
  {
      $this->line('<info>Ayra</info> version <comment>'.Ayra::VERSION.'</comment>');
      $this->line('A Nested Set pattern implementation for the Eloquent ORM.');
      $this->line('<comment>Copyright (c) 2013 Estanislau Trepat</comment>');
  }
}
