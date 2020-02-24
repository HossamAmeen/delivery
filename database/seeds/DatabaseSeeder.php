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
       
        App\Models\Client::create(
            [
                'name' => 'hossam' ,
                 'email'=>"hossam@gmail.com" ,
                  'password' =>bcrypt('admin'),
                  'phone' => "01010079798" ,
                 'address' => "assuit", 
                 'city_id' => 1
            ]
        );
        
        App\Models\Delivery::create(
            [
                'name' => 'hossam' ,
                 'email'=>"hossam@gmail.com" ,
                  'password' =>bcrypt('admin'),
                  'phone' => "01010079798" ,
                 'address' => "assuit", 
                 'attendance' => "10:00",
                 'departure' => "17:00",
               
            ]
        );
      
        App\Models\Order::create(
            [
                'title' => 'ديلفري' ,
               
                  'phone' => "01010079798" ,
                 'address' => "assuit", 
                 'client_id' => 1 ,
                 'delivery_id' => 1 , 
                 'price' => 5,
                 'delivery_price' => 100,
                 'status' => 1,
                 'description' => "ربع فراخ"
            ]
        );

          
        App\Models\Order::create(
            [
                'title' => 'ديلفري' ,
                
                  'phone' => "01010079798" ,
                 'address' => "assuit", 
                 'client_id' => 1 ,
                 'delivery_id' => 1 , 
                 'price' => -5,
                 'delivery_price' => 10,
                 'status' => 4,
                 'description' => "ربع فراخ"
            ]
        );

    }
}
