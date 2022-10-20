<?php

namespace App\Product\DataProviders;

use App\Http\Resources\YDataProviderResource;
use App\Product\Interfaces\DataProviderInterface;

class YFileDataProvider  extends FileDataProviderAdapter implements DataProviderInterface
{
    protected string $providerName = 'DataProviderY.json';

    public function mapOptions(array $options = []) : ?array
    {
        $filters['StatusCode'] = isset($options['statusCode']) ? ($options['statusCode'] === 'instock' ? 100 : 200): null;
        $filters['IncludeVAT'] = isset($options['includeVAT']) ? ($options['includeVAT'] == 1  ? 'yes' : 'no'): null;
        $filters['OfferEndDate'] = $options['offerEndDate'] ?? null;
        $filters['ProductCurrency'] = $options['productCurrency'] ?? null;
        $filters['ProductIdentification'] = $options['productIdentification']?? null;

        return array_filter($filters);
    }

    public function getData(array $options = [])
    {
        return YDataProviderResource::collection(parent::getData($this->mapOptions($options)));

    }
}
