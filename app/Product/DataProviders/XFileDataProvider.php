<?php

namespace App\Product\DataProviders;

use App\Http\Resources\XDataProviderResource;
use App\Product\Interfaces\DataProviderInterface;

class XFileDataProvider extends FileDataProviderAdapter implements DataProviderInterface
{
    protected string $providerName = 'DataProviderX.json';
    protected array $options = [];

    public function mapOptions(array $options = []) : array
    {
        $filters['StatusCode'] = isset($options['statusCode']) ? ($options['statusCode'] === 'instock' ? 1 : 2): null;
        $filters['IncludeVAT'] = isset($options['includeVAT']) ? (int) $options['includeVAT']:  null;
        $filters['OfferEndDate'] = $options['offerEndDate'] ?? null;
        $filters['ProductCurrency'] = $options['productCurrency']?? null;
        $filters['ProductIdentification'] = $options['productIdentification']?? null;

        return $filters;
    }

    public function getData(array $options = [])
    {
        $filters = array_filter($this->mapOptions($options));

        return XDataProviderResource::collection(parent::getData($filters));
    }
}
