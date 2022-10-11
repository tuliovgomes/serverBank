<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {user?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

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
     * @return int
     */
    public function handle()
    {
        $userName = $this->argument('user') ? $this->argument('user') : $this->ask('What is your name?');
        $userEmail = $this->ask('What is the user e-mail?');
        $password = Str::random(20);

        $user = User::firstOrCreate([
            'name' => $userName,
            'email' => $userEmail,
            'password' => bcrypt($password),
        ]);

        $apiKey = custom_token('ak');
        $apiSecret = custom_token('as');

        $user->remember_token = custom_token('rt');
        $user->api_key = $apiKey;
        $user->api_secret = $apiSecret;
        $user->email_verified_at = now();
        $user->save();

        $this->info('User Api Key: ' . $apiKey);
        $this->info('User Api Secret: ' . $apiSecret);
        $this->info('User Password: ' . $password);
    }
}
