<?php

namespace Database\Seeders;

use App\Models\User;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@gmail.com';
        $user->password = '$2a$12$FTdUjFg9nrmLt9QalS.gYODlk3LZ9x0UDN4U5M/r0o0G1RYcyaP9y'; //asdasdasd
        $user->save();

        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1
        ]);

    }
}
