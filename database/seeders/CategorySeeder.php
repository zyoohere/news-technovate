<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $mainCategories = [
            'Otomotif' => ['Motor', 'Mobil', 'Sport', 'Niaga', 'Komunitas'],
            'Teknologi' => ['Gadget', 'AI & Data', 'Startup', 'Review'],
            'Bisnis' => ['Fintech', 'UMKM', 'Ekonomi', 'Investasi'],
        ];
        foreach ($mainCategories as $main => $subs) {
            $mainCategory = Category::create([
                'nama' => $main,
                'slug' => Str::slug($main),
                'parent_id' => null,
            ]);

            foreach ($subs as $sub) {
                Category::create([
                    'nama' => $sub,
                    'slug' => Str::slug($sub),
                    'parent_id' => $mainCategory->id,
                ]);
            }
        }
    }
}
