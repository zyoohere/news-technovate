<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Faker\Factory as Faker;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $articles = Article::all();
        $users = User::where('role', 'user')->get();

        foreach ($articles as $article) {
            $commentCount = rand(10, 20);

            for ($i = 0; $i < $commentCount; $i++) {
                // Create a comment for each article
                $user = $users->random();
                Comment::create([
                    'article_id' => $article->id,
                    'user_id' => $users->random()->id,
                    'content' => $faker->paragraph(),
                ]);
            }
        }
    }
}
