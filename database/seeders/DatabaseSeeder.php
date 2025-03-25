<?php

namespace Database\Seeders;

use App\Models\PlayerForm;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'MBCS Developer',
            'email' => 'mbcsdev@mbcsww.com',
            'password' => Hash::make('password'), 
        ]);

        User::factory()->create([
            'name' => 'Tommy',
            'email' => 'tommy@icreatives.com.my',
            'password' => Hash::make('gGTgE7arzjg8MKO'), 
        ]);

        User::factory()->create([
            'name' => 'Jessie',
            'email' => 'jessie@icreatives.com.my',
            'password' => Hash::make('ok7VcPe3vHEcBRo'), 
        ]);

        PlayerForm::factory(10)->forWeek('Week1')->withoutScore()->withoutReceipt()->create();
        PlayerForm::factory(10)->forWeek('Week2')->withoutScore()->withoutReceipt()->create();
        PlayerForm::factory(10)->forWeek('Week3')->withoutScore()->withoutReceipt()->create();
        PlayerForm::factory(10)->forWeek('Week4')->withoutScore()->withoutReceipt()->create();
        PlayerForm::factory(10)->forWeek('Week5')->withoutScore()->withoutReceipt()->create();
        PlayerForm::factory(10)->forWeek('Week6')->withoutScore()->withoutReceipt()->create();
        PlayerForm::factory(10)->forWeek('Week7')->withoutScore()->withoutReceipt()->create();
        PlayerForm::factory(10)->forWeek('Week8')->withoutScore()->withoutReceipt()->create();
        
    }
}
