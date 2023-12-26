<?php

namespace Database\Seeders;

use App\Models\BusinessDay;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class BusinessDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return BusinessDay::create([
            'current_date' => Carbon::yesterday(),
            'updated_by' => Auth::id() ?? 1,
        ]);
    }
}
