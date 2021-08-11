<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookApiTest extends TestCase
{
    use RefreshDatabase;

    public function testHitOnBooksApiReturnsJson()
    {
        $response = $this->getJson('/api/books');
        $response->assertOk();
        $response->assertHeader("Content-Type", "application/json");
    }

    public function testHitOnBooksApiReturnDesignatedContract()
    {
        $book = Book::factory()->create();
        $response = $this->getJson('/api/books');
        $response->assertJson([
            "books" => [
                [
                    "book_id" => $book->id,
                    "title" => $book->title,
                    "description" => $book->description,
                    "author_name" => $book->author->name,
                    "ISBN" => $book->ISBN
                ]
            ]
        ]);

    }
}
