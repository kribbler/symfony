<?php
declare(strict_types=1);

namespace App\Engine\ApiBundle\Tests\Service;

use App\Engine\ApiBundle\Service\ApiProcessor;
use \Mockery\Adapter\Phpunit\MockeryTestCase;

class ApiProcessorTest extends MockeryTestCase
{
    /** @var ApiProcessor */
    private $service;

    protected function setUp()
    {
        $this->service = new ApiProcessor();
    }

    public function testGetBooksByAuthor(): void
    {
        $result = $this->service->getBooksByAuthor(
            'name'
        );
        
        $this->assertIsArray($result);
    }

    public function testGetCategories(): void
    {
        $result = $this->service->getCategories(
            'name'
        );
        
        $this->assertIsArray($result);
    }

    public function testGetBooksByCategory(): void
    {
        $result = $this->service->getBooksByCategory(
            'name'
        );
        
        $this->assertIsArray($result);
    }

    public function testGetBooksByAuthorAndCategory(): void
    {
        $result = $this->service->getBooksByAuthorAndCategory(
            'authorName', 'categoryName'
        );
        
        $this->assertIsArray($result);
    }
}