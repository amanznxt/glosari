<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'     => 'Amanz',
            'email'    => 'glossari@amanz.my',
            'password' => bcrypt('password'),
        ]);
        $this->command->info('Default User Created.');
        $this->command->info('E-mail: glossari@amanz.my');
        $this->command->info('Password: password');
    }
}
