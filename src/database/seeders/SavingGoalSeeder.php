<?php

namespace Database\Seeders;

use App\Models\SavingGoal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SavingGoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SavingGoal::create([
            'name' => '旅行資金',
            'target_amount' => 150000,
            'current_amount' => 4000,
            'target_date' => '2027-01-02',
        ]);

        SavingGoal::create([
            'name' => 'ライブ資金',
            'target_amount' => 160000,
            'current_amount' => 4000,
            'target_date' => '2027-01-02',
        ]);
    }
}
