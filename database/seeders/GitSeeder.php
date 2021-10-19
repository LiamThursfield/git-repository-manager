<?php

namespace Database\Seeders;

use App\Models\Git\Repository;
use Illuminate\Database\Seeder;

class GitSeeder extends Seeder
{
    public function run()
    {
        Repository::factory()->count(5)->hasPullRequests(3)->create();
    }
}
