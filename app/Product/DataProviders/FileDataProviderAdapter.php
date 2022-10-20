<?php

namespace App\Product\DataProviders;

use App\Helpers\JsonStreamReader;
use App\Product\Interfaces\FileDataProviderAdapterInterface;

class FileDataProviderAdapter implements FileDataProviderAdapterInterface
{
    protected string $providerName;
    protected JsonStreamReader $jsonStreamReader;

    public function __construct()
    {
        $this->setJsonStreamReader();
    }

    protected function buildPath(): string
    {
        return storage_path('app/public/'. $this->providerName);
    }

    protected function setJsonStreamReader()
    {
        $this->jsonStreamReader = new JsonStreamReader($this->buildPath());
    }

    protected function closeStreamReader()
    {
        $this->jsonStreamReader->close();
    }

    public function getData(array $options = [])
    {
        foreach ($this->jsonStreamReader->get() as $product) {
            if ($this->isMatched($product, $options)) {
                $products[] = $product;
            }
        }

        $this->closeStreamReader();
        return $products;
    }

    protected function isMatched($product , $options): bool
    {
        if (!empty($options)) {
            foreach ($options as $index => $option) {
                if ($product->{$index} !== $option) {
                    return false;
                }
            }
        }
        return true;
    }
}
