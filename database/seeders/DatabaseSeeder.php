<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Batformat\EntityAttributes\Persist\Models\Attribute;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $attributes = [
            [
                'name' => 'Город',
                'code' => 'city',
                'type' => 'text',
            ],
            [
                'name' => 'Статус',
                'code' => 'status',
                'type' => 'select',
            ],
        ];

        foreach ($attributes as $attribute) {
            Attribute::create([
                'name' => $attribute['name'],
                'code' => $attribute['code'],
                'type' => $attribute['type'],
            ]);
        }
    }
}