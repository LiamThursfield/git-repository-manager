<?php

namespace Database\Seeders;

use App\Models\Git\Repository;
use Illuminate\Database\Seeder;

class GitSeeder extends Seeder
{
    public function run()
    {
        Repository::factory()->count(50)->hasPullRequests(10)->create();
    }
}
