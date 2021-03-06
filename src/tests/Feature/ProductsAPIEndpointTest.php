<?php

namespace Tests\Feature;

use Database\Factories\ProductFactory;
use Tests\TestCase;

class ProductsAPIEndpointTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->refreshApplication();
        $this->refreshDatabase();
    }

    public function test_1()
    {
        $this->withoutMiddleware();
        $productFactory = new ProductFactory();

        $data = $productFactory
            ->count(100)
            ->create()
            ->toArray();

        $actual = $this
            ->get('/api/v1/products?per_page=100')
            ->json('data');

        $this->assertEquals($actual, $data);
    }
}
