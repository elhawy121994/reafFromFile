<?php

namespace Tests\Feature\Controllers;

use App\Http\Resources\XDataProviderResource;
use App\Http\Resources\YDataProviderResource;
use App\Product\DataProviders\XFileDataProvider;
use App\Product\DataProviders\YFileDataProvider;
use App\Product\Interfaces\DataProviderInterface;
use App\Services\Interfaces\ProductServiceInterface;
use App\Services\ProductService;
use Mockery;
use Tests\TestCase;

class ProductControllerTest extends TestCase

{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testGetXDDataRequestValidationFail()
    {
        $productServiceMock = Mockery::mock(ProductServiceInterface::class);

        $productServiceMock->shouldNotHaveReceived('list');
        $this->app->instance(ProductService::class, $productServiceMock);

        $response = $this->getJson('/api/v1/products/?provider=DataProviderWE&statusCode=475');
        $response->assertUnprocessable();
        $this->assertJson('{"message":"The given data was invalid.","errors":{"statusCode":["The selected status code is invalid."],"provider":["The selected provider is invalid."]}}');
    }
}
