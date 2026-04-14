<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            'title' => 'Laskar Pelangi',
            'author' => 'Agisna',
            'year' => '2024',
            'publisher' => 'laskar',
            'city' => 'Cianjur',
            'bookshelf_id' => '1'
        ]);
    }
}
