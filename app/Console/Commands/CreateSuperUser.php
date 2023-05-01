<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;

class CreateSuperUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-super-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a super user from user input';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask("Name for this user?");
        $email = $this->ask("Email for user?");
        $password = $this->secret("Password for user?");

        if ($this->confirm("Create user with email ".$email."?")) {
            $role = Role::where('name', 'super-admin')->get();

            if ($role[0]) {
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                ]);
                $user->assignRole([$role[0]->id]);

                if ($user) {
                    $this->info("User with email ".$email." successfully create.");
                }
            }
        }
    }
}
