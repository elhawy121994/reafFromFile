<?php

namespace Tests\Feature\Controllers;

use App\Http\Resources\XDataProviderResource;
use App\Http\Resources\YDataProviderResource;
use App\Product\DataProviders\XFileDataProvider;
use App\Product\DataProviders\YFileDataProvider;
use App\Product\Interfaces\DataProviderInterface;
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

    public function testGetXDataProductResponseSuccessfully()
    {
        $collection = XDataProviderResource::collection(json_decode(json_encode([
            [
                "ProductIdentification" => "d3d29d70-1d25-11e3-0000-034165a3a613",
                "ProductName" => "Universal Outdoor Tactical Holster Military Molle Hip Waist Belt Bag Wallet",
                "ProductCurrency" => "USD",
                "ProductOriginalPrice" => 50,
                "ProductCurrentPrice" => 45,
                "StatusCode" => 2,
                "IncludeVAT" => 1,
                "OfferEndDate" => "22/12/2018"
            ],
            [
                "ProductIdentification" => "d3d29d70-1d25-11e3-111-034165a3a613",
                "ProductName" => "Universal Outdoor Tactical Holster Military Molle Hip Waist Belt Bag Wallet",
                "ProductCurrency" => "USD",
                "ProductOriginalPrice" => 50,
                "ProductCurrentPrice" => 45,
                "StatusCode" => 1,
                "IncludeVAT" => 1,
                "OfferEndDate" => "22/12/2018"
            ]
        ])));

        $dataProviderX = Mockery::mock(DataProviderInterface::class);

        $dataProviderX->shouldReceive('getData')
            ->once()
            ->andReturn($collection);

        $this->app->instance(XFileDataProvider::class, $dataProviderX);


        $response = $this->getJson('/api/v1/products/?provider=DataProviderX');
        $response->assertStatus(200);

        $response->assertJson([
            [
                "id" => "d3d29d70-1d25-11e3-0000-034165a3a613",
                "name" => "Universal Outdoor Tactical Holster Military Molle Hip Waist Belt Bag Wallet",
                "currency" => "USD",
                "original_price" => 50,
                "current_price" => 45,
                "status" => 2,
                "include_vat" => 1,
                "end_date" => "22/12/2018"
            ],
            [
                "id" => "d3d29d70-1d25-11e3-111-034165a3a613",
                "name" => "Universal Outdoor Tactical Holster Military Molle Hip Waist Belt Bag Wallet",
                "currency" => "USD",
                "original_price" => 50,
                "current_price" => 45,
                "status" => 1,
                "include_vat" => 1,
                "end_date" => "22/12/2018"
            ]
        ]);
    }

    public function testGetYDataProductResponseSuccessfully()
    {
        $collection = YDataProviderResource::collection(json_decode(json_encode([
            [
                "id" => "4fc2-a8d1",
                "name" => "Ted Baker Womens Lotta Cc Holder",
                "description" => "This purse has been designed for your style and comfort. It can be used to store and carry your personal items, which makes it a great asset for yourself and/or a great gift for a loved one or friend. We assure you the authenticity of the product and we strive hard to ensure that it comes to you at an attractive price.",
                "currency" => "USD",
                "original_price" => 50,
                "current_price" => 45,
                "status" => 100,
                "include_VAT" => "yes",
                "end_date" => "2018-10-22"
            ],
            [
                "id" => "4fc2-a8d2",
                "name" => "Ted Baker Mens Lotta Cc Holder",
                "description" => "This purse has been designed for your style and comfort. It can be used to store and carry your personal items, which makes it a great asset for yourself and/or a great gift for a loved one or friend. We assure you the authenticity of the product and we strive hard to ensure that it comes to you at an attractive price.",
                "currency" => "USD",
                "original_price" => 50,
                "current_price" => 45,
                "status" => 200,
                "include_VAT" => "yes",
                "end_date" => "2018-10-22"
            ]
        ])));

        $dataProviderY = Mockery::mock(DataProviderInterface::class);

        $dataProviderY->shouldReceive('getData')
            ->once()
            ->andReturn($collection);

        $this->app->instance(YFileDataProvider::class, $dataProviderY);


        $response = $this->getJson('/api/v1/products/?provider=DataProviderY');
        $response->assertStatus(200);

        $response->assertJson([
            [
                "id" => "4fc2-a8d1",
                "name" => "Ted Baker Womens Lotta Cc Holder",
                "description" => "This purse has been designed for your style and comfort. It can be used to store and carry your personal items, which makes it a great asset for yourself and/or a great gift for a loved one or friend. We assure you the authenticity of the product and we strive hard to ensure that it comes to you at an attractive price.",
                "currency" => "USD",
                "original_price" => 50,
                "current_price" => 45,
                "status" => 100,
                "include_vat" => "yes",
                "end_date" => "2018-10-22"
            ],
            [
                "id" => "4fc2-a8d2",
                "name" => "Ted Baker Mens Lotta Cc Holder",
                "description" => "This purse has been designed for your style and comfort. It can be used to store and carry your personal items, which makes it a great asset for yourself and/or a great gift for a loved one or friend. We assure you the authenticity of the product and we strive hard to ensure that it comes to you at an attractive price.",
                "currency" => "USD",
                "original_price" => 50,
                "current_price" => 45,
                "status" => 200,
                "include_vat" => "yes",
                "end_date" => "2018-10-22"
            ]
        ]);
    }

    public function testFilterGetXDataProductResponseSuccessfully()
    {
        $collection = XDataProviderResource::collection(json_decode(json_encode([
            [
                "ProductIdentification" => "d3d29d70-1d25-11e3-0000-034165a3a613",
                "ProductName" => "Universal Outdoor Tactical Holster Military Molle Hip Waist Belt Bag Wallet",
                "ProductCurrency" => "USD",
                "ProductOriginalPrice" => 50,
                "ProductCurrentPrice" => 45,
                "StatusCode" => 1,
                "IncludeVAT" => 1,
                "OfferEndDate" => "22/12/2018"
            ],
            [
                "ProductIdentification" => "d3d29d70-1d25-11e3-111-034165a3a613",
                "ProductName" => "Universal Outdoor Molle Hip Waist Belt Bag Wallet",
                "ProductCurrency" => "USD",
                "ProductOriginalPrice" => 50,
                "ProductCurrentPrice" => 45,
                "StatusCode" => 2,
                "IncludeVAT" => 1,
                "OfferEndDate" => "22/12/2018"
            ],
            [
                "ProductIdentification" => "d3d29d70-1d25-11e3-222-034165a3a613",
                "ProductName" => "Universal Military Molle Hip Waist Belt Bag Wallet",
                "ProductCurrency" => "USD",
                "ProductOriginalPrice" => 50,
                "ProductCurrentPrice" => 45,
                "StatusCode" => 1,
                "IncludeVAT" => 1,
                "OfferEndDate" => "22/12/2018"
            ]
        ])));

        $dataProviderX = Mockery::mock(DataProviderInterface::class);

        $dataProviderX->shouldReceive('getData')
            ->once()
            ->andReturn($collection);

        $this->app->instance(XFileDataProvider::class, $dataProviderX);


        $response = $this->getJson('/api/v1/products/?provider=DataProviderX&statusCode=instock');
        $response->assertStatus(200);

        $response->assertJson([
            [
                "id" => "d3d29d70-1d25-11e3-0000-034165a3a613",
                "name" => "Universal Outdoor Tactical Holster Military Molle Hip Waist Belt Bag Wallet",
                "currency" => "USD",
                "original_price" => 50,
                "current_price" => 45,
                "status" => 1,
                "include_vat" => 1,
                "end_date" => "22/12/2018"
            ],
            [
                "id" => "d3d29d70-1d25-11e3-222-034165a3a613",
                "name" => "Universal Military Molle Hip Waist Belt Bag Wallet",
                "currency" => "USD",
                "original_price" => 50,
                "current_price" => 45,
                "status" => 1,
                "include_vat" => 1,
                "end_date" => "22/12/2018"
            ]
        ]);
    }

}
