<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Create the admin user
        User::create(
            [
                'name'          => 'Axel Espinosa',
                'email'         => 'axeldavid45@gmail.com',
                'phone'         => '9611581478',
                'password'      => Hash::make('123456789'),
                'administrator' => true
            ]
        );

        //Creating the cashier
        User::create(
            [
                'name'          => 'Cajero 1',
                'email'         => 'cajero@cajero.com',
                'phone'         => '9615545454',
                'password'      => Hash::make('123456789'),
                'administrator' => false
            ]
        );
        factory(App\Category::class, 2)->create();
        factory(App\Product::class, 10)->create();
    }
}
