<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VideoCategories;

class VideoCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VideoCategories::create([
            'category' => 'Autos & Vehicles',
            'category_status' => 1
        ]);

        VideoCategories::create([
            'category' => 'Movies',
            'category_status' => 1
        ]);

        VideoCategories::create([
            'category' => 'Documentaries',
            'category_status' => 1
        ]);

        VideoCategories::create([
            'category' => 'Music',
            'category_status' => 1
        ]);

        VideoCategories::create([
            'category' => 'Pets & Animals',
            'category_status' => 1
        ]);

        VideoCategories::create([
            'category' => 'Gaming',
            'category_status' => 1
        ]);

        VideoCategories::create([
            'category' => 'People & Blogs',
            'category_status' => 1
        ]);
    }
}
