<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => bcrypt('123456'),
                'level' =>1,
                'email' =>'admin@dirafarma.com'
            ],
            [
                'name' => 'Kasir',
                'username' => 'kasir',
                'password' => bcrypt('123456'),
                'level' =>2,
                'email' =>'kasir@dirafarma.com'
            ],
            [
                'name' => 'Pimpinan',
                'username' => 'pegawai',
                'password' => bcrypt('123456'),
                'level' =>3,
                'email' =>'pegawai@dirafarma.com'
            ],
        ];

        foreach($user as $key => $value ){
            User::create($value);
        }
    }
}
