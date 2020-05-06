<?php

use App\FeeType;
use Illuminate\Database\Seeder;

class FeeTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fee_types = [
            [
                'name' => 'Entry Fee',
                'value' => 'entry_fee'
            ],
            [
                'name' => 'Unit Rate',
                'value' => 'unit_rate',
            ]
        ];

        foreach($fee_types as $fee_type) {
            factory(App\FeeType::class)->create([
                'name' => $fee_type['name'],
                'value' => $fee_type['value'],
            ]);
        }
    }
}
