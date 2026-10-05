<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    public function test_books_index_page_loads(): void
    {
        $book = Book::factory()->create();

        $response = $this->get('/books');

        $response->assertStatus(200);
        $response->assertSee('Data Buku');
        $response->assertSee($book->title);
    }

    public function test_book_detail_page_loads(): void
    {
        $book = Book::factory()->create();

        $response = $this->get('/books/' . $book->id);

        $response->assertStatus(200);
        $response->assertSee('Detail Buku');
        $response->assertSee((string) $book->id);
        $response->assertSee($book->title);
    }

    public function test_book_create_page_loads(): void
    {
        $response = $this->get('/books/create');

        $response->assertStatus(200);
        $response->assertSee('Tambah Buku');
    }

    public function test_books_index_has_per_page_selector(): void
    {
        $response = $this->get('/books');

        $response->assertStatus(200);
        $response->assertSee('name="per_page"', false);
        $response->assertSee('value="10"', false);
    }

    public function test_book_can_be_updated(): void
    {
        $book = Book::factory()->create([
            'title' => 'Judul Lama',
            'author' => 'Penulis Lama',
            'price' => 50000,
            'stock' => 2,
        ]);

        $response = $this->put('/books/' . $book->id, [
            'title' => 'Judul Baru',
            'isbn' => '9781234567890',
            'author' => 'Penulis Baru',
            'publisher' => 'Penerbit Baru',
            'published_year' => 2024,
            'price' => 75000,
            'stock' => 5,
            'description' => 'Deskripsi baru',
        ]);

        $response->assertRedirect('/books');
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Judul Baru',
            'author' => 'Penulis Baru',
            'price' => 75000,
        ]);
    }

    public function test_book_can_be_deleted(): void
    {
        $book = Book::factory()->create();

        $response = $this->delete('/books/' . $book->id);

        $response->assertRedirect('/books');
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
