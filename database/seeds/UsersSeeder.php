<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\User::create([
            'uniId' => 'administrator',
            'status' => 0,
            'userRole' => 1,
            'username' => 'administrator',
            'email' => 'admin@mydomain.com',
            'password' => bcrypt('admin12345'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        App\User::create([
            'uniId' => 'counsellor',
            'status' => 0,
            'userRole' => 2,
            'username' => 'counsellor',
            'email' => 'counsellor@mydomain.com',
            'password' => bcrypt('test1234'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        App\User::create([
            'uniId' => 'student',
            'status' => 0,
            'userRole' => 3,
            'username' => 'student',
            'email' => 'student@mydomain.com',
            'password' => bcrypt('test1234'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // factory(App\User::class, 72)->create();
    }
}
