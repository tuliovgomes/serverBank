<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate([
            'name' => 'Lucas Colette',
            'email' => 'lucas@yampi.com.br',
            'password' => 'password',
        ]);

        $user->password = bcrypt('yampi');
        $user->remember_token = custom_token('rt');
        $user->api_key = custom_token('ak');
        $user->email_verified_at = now();
        $user->save();
    }
}
