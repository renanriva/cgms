<?php

use Illuminate\Database\Seeder;
use App\University;

class UniversityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $university = new University();
        $university->name = 'Universidad de Cuenca';
        $university->created_by = 1;
        $university->updated_by = 1;
        $university->save();


        $university = new University();
        $university->name = 'Plataforma mecapacito';
        $university->created_by = 1;
        $university->updated_by = 1;
        $university->save();


        $university = new University();
        $university->name = 'Universidad de Guayaquil';
        $university->created_by = 1;
        $university->updated_by = 1;
        $university->save();
    }
}
