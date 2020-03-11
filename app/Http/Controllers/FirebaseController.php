<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id , $id2)
    {
        // return __DIR__ ;
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/delivery-e3e58-firebase-adminsdk-imo2m-b7f0400810.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://delivery-e3e58.firebaseio.com/')
        ->create();

        $database = $firebase->getDatabase();

        // $database->getReference('/deliveries') // this is the root reference
        // ->update(['1' => 55 ]);

        $reference = $database->getReference('/deliveries');

        $snapshot = $reference->getSnapshot()->getValue();
       return  $snapshot;
        $ids =   $database->getReference('/deliveries')->getChildKeys();

        // return  $database->getReference('/deliveries')->getChildKeys();
       
        $database->getReference('deliveries')->remove();
        $$snapshot[$id] = $id2;
        $newPost = $database
        ->getReference('/deliveries')
        ->set($snapshot);
       
        // return $database->getChild() ;
        // $newPost = $database
        // ->getReference('/')
        // ->push([
        //     $id => $id2
        // ]);
       
        echo '<pre>';
        print_r($newPost->getvalue() );
    }

}