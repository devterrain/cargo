<?php

namespace Database\Seeders;

use App\Models\contractor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContractorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contractor = contractor::create([
            'contractor_name' => 'كايرو ثري ايه',
            'contractor_notes' => 'مقاول النقل الرئيسي',
            'created_by' => 'Admin'
        ]);
    }
}
