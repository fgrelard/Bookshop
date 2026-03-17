<?php
namespace Cesi\Bookshop\Tests;

use Cesi\Bookshop\Book;
use Cesi\Bookshop\Library;
use PHPUnit\Framework\TestCase;

class LibraryTest extends TestCase {
    
    
    private $library;
    private $book1;
    private $book2;

    protected function setUp(): void {
        $this->library = new Library();
        $this->book1 = new Book('The Hobbit', 'J.R.R. Tolkien', '9780261102217');
        $this->book2 = new Book('The Lord of the Rings', 'J.R.R. Tolkien', '9780261102385');
    }
    
    public function testAddBook() {
        $this->library->addBook($this->book1);
        $this->assertSame([$this->book1], $this->library->getBooks());
        return $this->library;
    }
    
    /**
     * 
     * 
     * @depends testAddBook
     */
    public function testFindBookByIsbn(Library &$library) {
        
        $this->assertSame($this->book1, $library->findBookByIsbn($this->book1->getIsbn()));

        $this->assertNull($this->library->findBookByIsbn($this->book2->getIsbn()));
    }
    
    public function testRemoveBookByIsbn() {
        $this->library->addBook($this->book1);
        $this->assertTrue($this->library->removeBookByIsbn($this->book1->getIsbn()));
        $this->assertSame([], $this->library->getBooks());

        $this->assertFalse($this->library->removeBookByIsbn($this->book2->getIsbn()));
    }
}