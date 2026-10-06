<?php
namespace Tests\Feature;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KatalogBukuTest extends TestCase
{
    use RefreshDatabase;

    public function test_1_index_akses() {
        $this->get(route('books.index'))->assertStatus(200);
    }
    public function test_2_search() {
        Book::factory()->create(['title' => 'Laravel UTS']);
        $this->get(route('books.index', ['q' => 'UTS']))->assertSee('Laravel UTS');
    }
    public function test_3_pagination() {
        Book::factory()->count(15)->create();
        $this->get(route('books.index', ['per_page' => 5]))->assertStatus(200);
    }
    public function test_4_stok_habis() {
        Book::factory()->create(['stock' => 0]);
        $this->get(route('books.index'))->assertSee('Stok Habis');
    }
    public function test_5_validasi() {
        $this->post(route('books.store'), ['title' => ''])->assertSessionHasErrors();
    }
    public function test_6_hapus() {
        $book = Book::factory()->create();
        $this->delete(route('books.destroy', $book->id))->assertRedirect();
    }
}