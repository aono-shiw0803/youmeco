<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          'id' => 1,
          'name' => '小野智美',
          'username' => 'tomomi.ono',
          'email' => 'tomomi.ono@zenken.co.jp',
          'password' => bcrypt('ono12345678'),
        ]);
    }
}
