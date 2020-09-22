<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            RecipeSeeder::class,
            CommentSeeder::class,
            FavoriteSeeder::class,
            NewsSeeder::class,
            SliderSeeder::class,
            LikeSeeder::class,
            AdminSeeder::class
        ]);
    }
}
