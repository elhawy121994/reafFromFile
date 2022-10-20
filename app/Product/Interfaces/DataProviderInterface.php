<?php

namespace App\Product\Interfaces;

interface DataProviderInterface
{
    public function getData(array $options = []);
    public function mapOptions(array $options = []) : ?array;
}
