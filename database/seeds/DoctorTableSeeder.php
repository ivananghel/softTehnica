<?php

use Illuminate\Database\Seeder;
use App\Models\Doctor;
class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			$range =range('A', 'Z');
        for ($i=0; $i < 5; $i++) { 

	    	Doctor::create([

	            'name' => 'Doctor ' . $i,

	            'type_procedure' => $range[$i],


	        ]);

    	}
    }
}
