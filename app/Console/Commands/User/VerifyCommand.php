<?php

namespace App\Console\Commands\User;

use App\User;
use Illuminate\Console\Command;

class VerifyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:verify {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifies user. Change status to active';

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
    public function handle()
    {
        //
        if (!$user = User::whereEmail($this->argument('email'))->first()) {
            $this->error('Undefined user');
            return false;
        }
        try {
            $user->verify();
        } catch (\DomainException $e) {
            $this->error($e->getMessage());
            return false;

        }
        $this->info('success '. $user->id);
        return true;

    }
}
