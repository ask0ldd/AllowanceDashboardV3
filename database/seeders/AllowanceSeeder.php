<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Allowance;

class AllowanceSeeder extends Seeder
{
    public function run()
    {
        Allowance::factory()->count(10)->create();
    }
}
