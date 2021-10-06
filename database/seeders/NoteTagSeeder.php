<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NoteTag;

class NoteTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NoteTag::factory()->count(10)->create();
    }
}
