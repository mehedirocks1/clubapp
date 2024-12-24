<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // Use the factory to create branches
        Branch::factory()->count(2)->create(); // Adjust the count to whatever number of branches you want
    }
}
