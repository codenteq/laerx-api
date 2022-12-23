<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PackageCreator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:create  {--path=default} {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Controller Request and Resource Generator';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (! $this->option('name')) {
            $this->error('Please enter the name');

            return false;
        }

        self::generator();

        return true;
    }

    /**
     * Create Controller Resource and Request
     *
     * @return void
     */
    public function generator(): void
    {
        $path = $this->option('path') == 'default' ? 'API/'.$this->option('name').'Controller'
            : 'API/'.$this->option('path').'/'.$this->option('name').'Controller';

        $this->call('make:controller', [
            'name' => $path,
            '--api' => true,
            '--resource' => true,
            '--model' => $this->option('name'),
        ]);
        $this->call('make:request', ['name' => $this->option('path').'/Store'.$this->option('name').'Request']);
        $this->call('make:request', ['name' => $this->option('path').'/Update'.$this->option('name').'Request']);
        $this->call('make:resource', ['name' => $this->option('path').'/'.$this->option('name').'Resource']);
        $this->call('make:test', ['name' => $this->option('path').'/'.$this->option('name').'ControllerTest']);
    }
}
