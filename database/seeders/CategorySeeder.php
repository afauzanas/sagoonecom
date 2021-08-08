<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Tepung Sagu'
        ]);

        DB::table('categories')->insert([
            'name' => 'Kue'
        ]);

        DB::table('categories')->insert([
            'name' => 'Ternak'
        ]);

        DB::table('categories')->insert([
            'name' => 'Tumbuhan'
        ]);

        DB::table('categories')->insert([
            'name' => 'Lainnya'
        ]);
    }
}
