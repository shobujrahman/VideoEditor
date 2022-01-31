<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<=10; $i++){

            DB::table('items')->insert([
                'name' => Str::random(10),
                'thumbnail' => Str::random(10),
                'url' => Str::random(10),
                'description' => Str::random(10),
                
            ]);
        }
    }
}
