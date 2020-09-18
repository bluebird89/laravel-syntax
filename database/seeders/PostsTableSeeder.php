<?php

namespace Database\Seeders;

use App\Models\Post;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = $this->withFaker();
        DB::table('posts')->insert([
            'url' => 'https://wwww.' . $faker->randomLetter . '.com',
            'title' => $faker->title,
        ]);

//        Post::factory(10)->create();
    }

    /**
     * 获取 Faker 实例
     *
     * @return Generator
     */
    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }
}
