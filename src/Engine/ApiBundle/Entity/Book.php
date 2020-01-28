<?php
declare(strict_types=1);

namespace App\Engine\ApiBundle\Entity;

use App\Engine\ApiBundle\Validator\Constraints as FormAssert;
use Symfony\Component\Validator\Constraints as Assert;

class Book
{
    /** 
     * @var string 
     * @Assert\NotBlank
     * @FormAssert\ContainsAlphanumeric
     */
    protected $isbn;

    /** @var string */
    protected $title;

    /** @var string */
    protected $author;

    /** @var string */
    protected $category;

    /** @var string */
    protected $price;

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): void
    {
        $this->isbn = $isbn;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }
}