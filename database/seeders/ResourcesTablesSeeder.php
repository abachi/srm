<?php

namespace Database\Seeders;

use App\Models\Resource\CodeSnippet;
use App\Models\Resource\File;
use App\Models\Resource\Link;
use Illuminate\Database\Seeder;

class ResourcesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Link::factory()->count(10)->create();
        CodeSnippet::factory()->count(10)->create();
        File::factory()->count(10)->create();
    }
}
