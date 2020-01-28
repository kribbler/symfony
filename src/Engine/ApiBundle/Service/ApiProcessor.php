<?php
declare(strict_types=1);

namespace App\Engine\ApiBundle\Service;

use Doctrine\Common\Collections\ArrayCollection;

class ApiProcessor
{
    const BOOKS = [
        [
            'isbn' => '978-1491918661',
            'title' => 'Learning PHP, MySQL & JavaScript: With jQuery, CSS & HTML5',
            'author' => 'Robin Nixon',
            'category' => [
                'PHP', 'Javascript'
            ],
            'price' => '9.99 GBP'
        ],
        [
            'isbn' => '978-0596804848',
            'title' => 'Ubuntu: Up and Running: A Power User\'s Desktop Guide',
            'author' => 'Robin Nixon',
            'category' => ['Linux'],
            'price' => '12.99 GBP'
        ],
        [
            'isbn' => '978-1118999875',
            'title' => 'Linux Bible',
            'author' => 'Christopher Negus',
            'category' => ['Linux'],
            'price' => '19.99 GBP'
        ],
        [
            'isbn' => '978-0596517748',
            'title' => 'JavaScript: The Good Parts',
            'author' => 'Douglas Crockford',
            'category' => ['Javascript'],
            'price' => ['8.99 GBP']
        ]
    ];

    private function getBooks(): array
    {
        return self::BOOKS;
    }

    public function getBooksByAuthor(string $authorName): array
    {
        $results = [];
        foreach ($this->getBooks() as $book) {
            if ($book['author'] == $authorName) {
                $results[] = $book;
            }
        }

        return $results;
    }

    public function getCategories(): array
    {
        $books = new ArrayCollection($this->getBooks());
        $results = [];
        foreach ($books as $book) {
            foreach ($book['category'] as $category){
                if (!in_array($category, $results)) {
                    $results[] = $category;
                }
            }
        }

        return $results;
    }

    public function getBooksByCategory(string $categoryName): array
    {
        $books = new ArrayCollection($this->getBooks());

        $results = [];
        foreach ($books as $book) {
            foreach ($book['category'] as $category){
                if (strcasecmp($category, $categoryName) == 0) {
                    $results[] = $book;
                }
            }
        }

        return $results;
    }

    public function getBooksByAuthorAndCategory(
        string $authorName,
        string $categoryName
    ): array {
        $books = new ArrayCollection($this->getBooks());
        
        $results = [];
        foreach ($books as $book) {
            if ($book['author'] == $authorName) {
                foreach ($book['category'] as $category){
                    if (strcasecmp($category, $categoryName) == 0) {
                        $results[] = $book;
                    }
                }
            }
        }

        return $results;
    }
}