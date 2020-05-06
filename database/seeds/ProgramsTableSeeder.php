<?php

use App\Program;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $internship = factory(Program::class, 1)->create([
            'name' => 'Internship',
            'value' => 'internship',
            'fee_type_id' => DB::table('fee_types')->where('value', 'entry_fee')->first()->id,
        ]);

        $inter_relocat = factory(Program::class, 1)->create([
            'name' => 'Internship + Relocation',
            'value' => 'inter_relocat',
            'fee_type_id' => DB::table('fee_types')->where('value', 'entry_fee')->first()->id,
        ]);

        $university = factory(Program::class, 1)->create([
            'name' => 'University',
            'value' => 'university',
            'fee_type_id' => DB::table('fee_types')->where('value', 'entry_fee')->first()->id,
        ]);

        $study =  factory(Program::class, 1)->create([
            'name' => 'Study',
            'value' => 'study',
            'fee_type_id' => DB::table('fee_types')->where('value', 'unit_rate')->first()->id,
        ]);
    }
}
