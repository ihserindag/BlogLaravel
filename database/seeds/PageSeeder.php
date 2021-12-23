<?php

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages=['Hakkımızda','Kariyer','Vizyon','Misyon'];
        $count=0;
        foreach ($pages as $page)
        {
            $count++;
            DB::table('pages')->insert([
                'title'=>$page,
                'slug'=>Str::slug($page,'-'),
                'image'=>'https://images.unsplash.com/photo-1516910817563-4df1c1b69058?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum pulvinar etiam non quam lacus. Vitae tempus quam pellentesque nec. Consectetur libero id faucibus nisl. Iaculis nunc sed augue lacus. Morbi tempus iaculis urna id volutpat lacus laoreet. Augue interdum velit euismod in pellentesque massa placerat. Malesuada fames ac turpis egestas maecenas. Id leo in vitae turpis massa sed elementum. Gravida in fermentum et sollicitudin ac orci phasellus. Vitae elementum curabitur vitae nunc sed velit.',
                'order'=>$count,
                'created_at'=>now(),
                'updated_at'=> now(),
            ]);
        }
    }
}
