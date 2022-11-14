<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BorrowedBook>
 */
class BorrowedBookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 4,
            'book_id' => 1,
            'due' => now('Asia/Jakarta')->addDays(3)->format('Y-m-d'),
            'borrowed_at' => now('Asia/Jakarta'),
            'returned_at' => now('Asia/Jakarta')->addDays(3),
        ];
    }
}
