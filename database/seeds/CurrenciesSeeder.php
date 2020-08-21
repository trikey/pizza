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
            ['code' => 'USD', 'format' => '$', 'is_base' => 0, 'rate' => 1.18],
            ['code' => 'EUR', 'format' => '€', 'is_base' => 1, 'rate' => 1],
        ]);

        $currencies->each(function ($currency) {
            Currency::create($currency);
        });
    }
}
