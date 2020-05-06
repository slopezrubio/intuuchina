<?php

use Illuminate\Database\Seeder;

use App\Fee;
use Illuminate\Support\Facades\DB;

class FeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $application_fee = factory(Fee::class, 1)->create([
            'name' => 'General Application Fee',
            'heading' => 'General Application Fee',
            'amount' => 30.00,
            'value' => 'application_fee',
            'jurisdiction' => 'es',
            'type' => DB::table('fee_types')->where('value', 'entry_fee')->first()->id,
        ]);

        $chinese_online_course = factory(Fee::class, 1)->create([
            'name' => 'Chinese Online Course Fee',
            'heading' => 'Chinese Online Course Fee',
            'amount' => 18.00,
            'value' => 'chinese_online_course',
            'minimum' => 40,
            'unit' => 'lesson',
            'jurisdiction' => 'es',
            'type' =>  DB::table('fee_types')->where('value', 'unit_rate')->first()->id,
        ]);

        $chinese_in_person_course = factory(Fee::class, 1)->create([
            'name' => 'Chinese In-Person Course Fee',
            'heading' => 'Chinese In-Person Course Fee',
            'value' => 'chinese_in-person_course',
            'amount' => 564.00,
            'minimum' => 1,
            'unit' => 'month',
            'jurisdiction' => 'es',
            'type' => DB::table('fee_types')->where('value', 'unit_rate')->first()->id,
        ]);
    }
}
