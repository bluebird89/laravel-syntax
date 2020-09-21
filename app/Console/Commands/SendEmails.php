<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Support\DripEmailer;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * @translator laravelacademy.org
     */
    protected $signature = 'email:send
                        {user : The ID of the user}
                        {--queue= : Whether the job should be queued}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send drip e-mails to a user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(DripEmailer $drip)
    {
        $name = $this->ask('What is your name?');
        $password = $this->secret('What is the password?');

        if ($this->confirm('Do you wish to continue? [y|N]')) {
            //
        }
        $name = $this->anticipate('What is your name?', ['Taylor', 'Dayle']);
        $name = $this->choice('What is your name?', ['Taylor', 'Dayle'], $defaultIndex);
        $userId = $this->argument('user');

        $drip->send(User::find($this->argument('user')));
    }
}
