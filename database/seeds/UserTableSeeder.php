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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        User::create([
            'name'     => 'Amanz',
            'email'    => 'glossari@amanz.my',
            'password' => bcrypt('password'),
        ])->attachRole(1);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $this->command->info('Default User Created.');
        $this->command->info('E-mail: glossari@amanz.my');
        $this->command->info('Password: password');
    }
}
