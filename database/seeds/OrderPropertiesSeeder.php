<?php

use Illuminate\Database\Seeder;
use App\OrderProperty;
use Illuminate\Support\Str;

class OrderPropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('order_properties')->truncate();

        $properties = collect([
            [
                'name' => 'Full name',
                'code' => Str::slug('Full name'),
                'required' => 1,
                'is_phone' => 0,
                'is_email' => 0
            ],
            [
                'name' => 'Phone',
                'code' => Str::slug('Phone'),
                'required' => 1,
                'is_phone' => 1,
                'is_email' => 0
            ],
            [
                'name' => 'Email',
                'code' => Str::slug('Email'),
                'required' => 1,
                'is_phone' => 0,
                'is_email' => 1
            ],
            [
                'name' => 'Address',
                'code' => Str::slug('Address'),
                'required' => 1,
                'is_phone' => 0,
                'is_email' => 0
            ],
            [
                'name' => 'Comment',
                'code' => Str::slug('Comment'),
                'required' => 0,
                'is_phone' => 0,
                'is_email' => 0
            ],
        ]);
        $properties->each(function ($property) {
            OrderProperty::create($property);
        });
    }
}
