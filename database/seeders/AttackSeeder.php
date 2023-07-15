<?php

namespace Database\Seeders;
use Carbon\Carbon;
use DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attacks = [
            ['name'=>'Cuerpo a cuerpo',
            'description'=>'Daño total = Puntos de ataque.'],
            ['name'=>'A distancia',
            'description'=>'Daño total = Puntos de ataque * 0.8.'],
            ['name'=>'Ulti',
            'description'=>'Daño total = Puntos de ataque x 2.']    
        ];

        foreach($attacks as $attack){

            $attackExist = DB::table('attacks')->where('name',$attack['name'])->first();

            if(empty($attackExist)){

                DB::table('attacks')->insert([
                    'name' => $attack['name'],
                    'description' => $attack['description'],
                    'created_at' =>  Carbon::now(),
                    'updated_at' =>  Carbon::now()
                ]);
            }
            
        }
       
    }
}
