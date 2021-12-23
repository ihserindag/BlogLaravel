<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(ConfigSeeder::class);
    }
}
