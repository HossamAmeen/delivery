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
        
        App\Models\Country::create(
            [
                'name' => 'مصر',
               
            ]
        );
        App\Models\City::create(
            [
                'name' => 'اسيوط',
                'country_id' => 1
            ]
        );

        App\Models\Service::create(
            [
                'name' => 'شراء دواء',
                'tybe' => 'خدمات توصيل',
                'is_avaible' => 1
            ]
        );
        
        App\Models\PriceList::create(
            [
                'name' => 'ديلفري',
               'price' => 1
            ]
        );
        $this->call([
            UserSeeder::class,
        //    ClientSeeder::class,
        ]);
     
        factory('App\Models\Configration',1)->create();
        factory('App\Models\User', 10)->create();

        factory('App\Models\Complaint', 10)->create();



    }
}
