<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=array(
            array(
                'name' => 'Smith',
                'email' => 'smith@user.com',
                'password'=>Hash::make('user'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Johnson',
                'email' => 'johnson@user.com',
                'password'=>Hash::make('user'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Williams',
                'email' => 'williams@user.com',
                'password'=>Hash::make('user'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Miller',
                'email' => 'miller@user.com',
                'password'=>Hash::make('user'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Davis',
                'email' => 'davis@user.com',
                'password'=>Hash::make('user'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            )

        );

        DB::table('users')->insert($data);
    }
}
