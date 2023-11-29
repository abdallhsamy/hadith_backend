<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::count() === 0 && app()->isLocal()) {

        }
    }
}
