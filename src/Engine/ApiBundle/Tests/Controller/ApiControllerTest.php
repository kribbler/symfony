<?php
declare(strict_types=1);

namespace App\Engine\ApiBundle\Tests\Controller;

use App\Engine\ApiBundle\Controller\ApiController;
use App\Engine\ApiBundle\Service\ApiProcessor;
use \Mockery as m;
use \Mockery\Adapter\Phpunit\MockeryTestCase;
use Symfony\Component\HttpFoundation\Request;

class ApiProcessorTest extends MockeryTestCase
{
    /** @var ApiController */
    private $controller;

    /** @var ApiProcessor */
    private $service;

    /** @var Request */
    private $request;

    protected function setUp(): void
    {
        $this->service = m::mock(ApiProcessor::class);

        $this->controller = new ApiController(
            $this->service
        );

        $this->request = m::mock(Request::class);
    }

    public function testGetByAuthor(): void
    {
        $authorName = 'author name';
        $books = [
            'title' => 'the_title'
        ];
        $this->request
            ->shouldReceive('get')
            ->with('name')
            ->once()
            ->andReturn($authorName);

        $this->service
            ->shouldReceive('getBooksByAuthor')
            ->with($authorName)
            ->once()
            ->andReturn($books);

        $response = $this->controller->authorAction($this->request);
        $this->assertEquals(json_encode($books), $response->getContent());
    }

    public function testListCategories(): void
    {
        $categories = ['the_category'];

        $this->service
            ->shouldReceive('getCategories')
            ->once()
            ->andReturn($categories);

        $response = $this->controller->listCategoriesAction($this->request);
        $this->assertEquals(json_encode($categories), $response->getContent());
    }

    public function testGetByCategory(): void
    {
        $categoryName = 'category name';
        $books = [
            'title' => 'the_title'
        ];
        $this->request
            ->shouldReceive('get')
            ->with('name')
            ->once()
            ->andReturn($categoryName);

        $this->service
            ->shouldReceive('getBooksByCategory')
            ->with($categoryName)
            ->once()
            ->andReturn($books);

        $response = $this->controller->categoryAction($this->request);
        $this->assertEquals(json_encode($books), $response->getContent());
    }

    public function testGetByAuthorAndCategory(): void
    {
        $authorName = 'author name';
        $categoryName = 'category name';
        $books = [
            'title' => 'the_title'
        ];

        $this->request
            ->shouldReceive('get')
            ->with('author_name')
            ->once()
            ->andReturn($authorName);

        $this->request
            ->shouldReceive('get')
            ->with('category_name')
            ->once()
            ->andReturn($categoryName);

        $this->service
            ->shouldReceive('getBooksByAuthorAndCategory')
            ->once()
            ->with($authorName, $categoryName)
            ->andReturn($books);

        $response = $this->controller->authorCategoryAction($this->request);
        $this->assertEquals(json_encode($books), $response->getContent());
    }
}
