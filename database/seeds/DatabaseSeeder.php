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
        
       
      
        $this->call([
            UserSeeder::class,
        //    ClientSeeder::class,
        ]);
     
        factory('App\Models\Configration',1)->create();
        factory('App\Models\User', 10)->create();

        factory('App\Models\Complaint', 10)->create();



    }
}
