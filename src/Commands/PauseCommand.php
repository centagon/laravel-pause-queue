<?php

namespace Centagon\PauseableQueue\Commands;

use Illuminate\Console\Command;

class PauseCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'queue:pause {--unpause}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pause queue worker daemons after their current job';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->option('unpause')) {
            $this->info('Broadcasting queue unpause signal.');
            $this->laravel['cache']->forget('illuminate:queue:pause');
            return;
        }
        
        $this->laravel['cache']->forever('illuminate:queue:pause', 1);
        $this->info('Broadcasting queue pause signal.');
    }
    
}
