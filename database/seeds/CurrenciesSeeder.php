<?php

use Illuminate\Database\Seeder;
use App\Currency;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('currencies')->truncate();

        $currencies = collect([
            ['code' => 'USD', 'format' => '$', 'base' => 0],
            ['code' => 'EUR', 'format' => '€', 'base' => 1],
        ]);

        $currencies->each(function ($currency) {
            Currency::create($currency);
        });
    }
}
