<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BorrowedBook;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (app()->isLocal()) {
            User::factory()->create([
                'name' => 'Test',
                'username' => 'test',
                'role' => User::ADMIN,
                'password' => bcrypt('password')
            ]);

            User::factory()->create([
                'name' => 'Pustakawan 1',
                'username' => 'pustakawan1',
                'role' => User::LIBRARIAN,
                'password' => bcrypt('password')
            ]);

            User::factory()->create([
                'name' => 'Pustakawan 2',
                'username' => 'pustakawan2',
                'role' => User::LIBRARIAN,
                'password' => bcrypt('password')
            ]);

            User::factory()->create([
                'name' => 'Member 1',
                'username' => 'member1',
                'role' => User::MEMBER,
                'password' => bcrypt('password'),
            ]);

            Book::factory()->create();

            BorrowedBook::factory()->create();
        }
    }
}
