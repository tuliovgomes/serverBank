<?php
namespace Database\Seeders;

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
            'name' => 'Default User',
            'email' => 'user@yampi.com.br',
            'password' => 'password',
        ]);

        $user->password = bcrypt('password');
        $user->remember_token = custom_token('rt');
        $user->api_key = custom_token('ak');
        $user->api_secret = custom_token('as');
        $user->email_verified_at = now();
        $user->save();
    }
}
