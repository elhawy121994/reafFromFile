<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListProductRequest;
use App\Services\Interfaces\ProductServiceInterface;

class ProductController extends BaseController
{
    protected  ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function list(ListProductRequest $request)
    {
        $options = $request->validated();
        return $this->productService->list($options);
    }
}
