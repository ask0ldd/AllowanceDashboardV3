<?php

namespace Database\Seeders;

use App\Models\TokenContract;
use Illuminate\Database\Seeder;

class TokenContractSeeder extends Seeder
{
    public function run()
    {
        TokenContract::factory()->count(11)->predefined()->create();
    }
}
