<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CategorySeeder extends Seeder
{

    public function run()
    {
        $categories=['Genel','Eğlence','Bilişim','Gezi','Teknoloji','Sağlık','Spor','Günlük Yaşam'];
        foreach ($categories as $category)
        {
            DB::table('categories')->insert([
            'name'=>$category,
            'slug'=>Str::slug($category,'-'),
            'created_at'=>now(),
             'updated_at'=> now(),
            ]);
        }
    }


}
