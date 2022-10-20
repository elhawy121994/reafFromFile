
## Challenge Idea
We have two providers collect data from them two main providers to get products that contain offers  in json files we need to read and make some filter operations on them to get the result

You can check the json files inside jsons folder 

- `DataProviderX` data is stored in [DataProviderX.json]
- `DataProviderY` data is stored in [DataProviderY.json]


`DataProviderX  schema is 
```
{
  ProductIdentification: 'd3d29d70-1d25-11e3-8591-034165a3a613',
  ProductName:"Universal Outdoor Tactical Holster Military Molle Hip Waist Belt Bag Wallet",
  ProductCurrency:'USD',
  ProductOriginalPrice: 50,
  ProductCurrentPrice: 45,
  StatusCode:1,
  IncludeVAT: 1,
  OfferEndDate : "22/12/2018"
}
```

we have two status for `DataProviderX` 

- `instock` which will have StatusCode `1`
- `outstock` which will have StatusCode `2`



`DataProviderY  schema is 
```
{
  id: '4fc2-a8d1',
  name:"Ted Baker Womens Lotta Cc Holder",
  description:"This purse has been designed for your style and comfort. It can be used to store and carry your personal items, which makes it a great asset for yourself and/or a great gift for a loved one or friend. We assure you the authenticity of the product and we strive hard to ensure that it comes to you at an attractive price.",
  currency:'USD',
  original_price: 50,
  current_price: 45,
  status:100,
  include_VAT: 'yes',
  end_date : "2018-10-22"
}

```

we have two status for `DataProviderX` 

- `instock` which will have StatusCode `100`
- `outstock` which will have StatusCode `200`



## Acceptance Criteria

Implement this API `/api/v1/products`

- It should list all products which combine transactaions from all the available provider`DataProviderX` and `DataProviderY` )
- It should be able to filter resullt by payment providers for example `/api/v1/products?provider=DataProviderX` it should return products from DataProviderX
- It should be able to filter result by statusCode (`instock`, `outstock`) 
for example /api/v1/products?statusCode=instock it should return all products from all providers that have status code instock
- It should be able to filer by amount range for example `/api/v1/products?balanceMin=10&balanceMax=100` it should return result between 10 and 100 including 10 and 100
- It should be able to combine all this filter together 

## The Evaluation

Task will be evaluated based on

1. Code quality and Working API
2. Application performance in reading large files 
3. Code scalability : ability to add  `DataProviderZ` by small changes
4. Unit tests coverage
5. Docker

You have to use the S.O.L.I.D principles and design patterns in this assesment to achieve


