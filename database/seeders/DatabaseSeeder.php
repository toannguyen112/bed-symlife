<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use JamstackVietnam\Blog\Models\Post;
use JamstackVietnam\Blog\Models\PostCategory;
use JamstackVietnam\Tag\Models\Tag;
use JamstackVietnam\Job\Models\Job;
use App\Models\History;

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
            RoleSeeder::class,
        ]);
    }
}
