<?php

use Illuminate\Database\Seeder;

class BreedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admin')->insert([
            [ 'username' => 'hau1@gmail.com','password' =>Hash::make( 123),'name' => 'hau','email' => 'hau1@gmail.com'],
           
          ]);
   
    }
}
