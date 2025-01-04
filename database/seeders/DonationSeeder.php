<?php

namespace Database\Seeders;

use App\Models\Donation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $model = Donation::class;
    public function run(): void
    {
        //
        Donation::factory(4)->create();
    }
}
