<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookValidationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    private $user;

    public function testCannotCreateBookWithEmptyTitle()
    {
        $response = $this->actingAs($this->user)->post('/books', $this->data(["title" => ""]));
        $response->assertSessionHasErrors(["title" => "title is required"]);
    }

    public function testCannotCreateBookWithEmptyDescription()
    {
        $response = $this->actingAs($this->user)->post('/books', $this->data(["description" => ""]));
        $response->assertSessionHasErrors(["description" => "description is required"]);
    }

    public function testDescriptionMinimumLengthIs20()
    {
        $response = $this->actingAs($this->user)->post('/books', $this->data(["description" => "test"]));
        $response->assertSessionHasErrors(["description" => "description minimum length is 20"]);
    }

    public function testAuthorIdMustBeValid()
    {
        $response = $this->actingAs($this->user)->post('/books', $this->data());
        $response->assertSessionHasErrors(["author_id" => "Author not valid"]);
    }

    public function testISBNMustBeOfValidFormat()
    {
        $response = $this->actingAs($this->user)->post('/books', $this->data(["ISBN" => "123"]));
        $response->assertSessionHasErrors(["ISBN" => "ISBN must be of valid format"]);
    }

    private function data($data = []): array
    {
        $default =  [
            "title" => "New Book",
            "description" => "New Book description",
            "author_id" => 1,
            "ISBN" => "12b-422-24ff",
        ];
        return array_merge($default, $data);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }
}
