<?php

namespace App\Console\Commands\User;

use App\User;
use Illuminate\Console\Command;

class RoleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:role {email} {role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $email = $this->argument('email');
        $role = $this->argument('role');
        if (!in_array($role, [User::ROLE_USER, User::ROLE_ADMIN])){
            $this->error('This role is not found');
        }

        if (!$user = User::whereEmail($email)->first()) {
            $this->error('Undefined user');
            return false;
        }
        try {
            $user->changeRole($role);
        } catch (\InvalidArgumentException $e) {
            $this->error($e->getMessage());
            return false;
        }

        $this->info('Role is successfully changed');
        return true;

    }
}
