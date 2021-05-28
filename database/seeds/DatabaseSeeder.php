<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Creating the cashier
        User::create(
            [
                'name'          => 'Cajero 1',
                'email'         => 'cajero@cajero.com',
                'phone'         => '9615545454',
                'email_verified_at' => time(),
                'password'      => Hash::make('123456789'),
                'administrator' => false
            ]
        );

        \App\Category::create([
            'name' => 'GENERAL'
                              ]);
        factory(App\Category::class, 2)->create();
        factory(App\Product::class, 10)->create();
        factory(\App\Client::class, 10)->create();
    }
}
