<?php
namespace Sapiti\Repositories;

use Sapiti\Objects\Shop\Order;
use Sapiti\Objects\Shop\Product;

class Cineville extends Repository
{

    public function getPackProductFromCustomerId(string $customerId, array $params=[]): ?Product
    {
        $apiResponse = $this->getAPIResponse('cineville/packproducts/',['customerid'=>$customerId],'GET');
        return \Sapiti\Objects\Shop\Product::getFromArray($apiResponse->getResponse());
    }

    public function getProductsForPackProduct(Product $packProduct, array $params=[]): array
    {
        $params['packproductid']=$packProduct->getId();
        $apiResponse = $this->getAPIResponse('cineville/products/',$params,'GET');
        return \Sapiti\Objects\Shop\Product::getMultipleFromArray($apiResponse->getResponse());
    }



	public function confirmProduct(Product $product, string $customerId): Product
    {
		$apiResponse = $this->getAPIResponse('cineville/products/'.$product->getId(),['customerid'=>$customerId],'POST');
		return \Sapiti\Objects\Shop\Product::getFromArray($apiResponse->getResponse());
	}

    public function cancelProduct(Product $product): bool
    {
        $apiResponse = $this->getAPIResponse('cineville/products/'.$product->getId(),[],'DELETE');
        return $apiResponse->isSuccess();
    }





	public function attachProductToMainProduct(Product $product, Product $mainProduct, string $customerId, $params=[]): ?Product
	{
		$params['mainproductid']=$mainProduct->getId();
        $params['customerid']=$customerId;
		$apiResponse = $this->getAPIResponse('cineville/products/'.$product->getId().'/attach',$params,'PATCH');
		return Product::getFromArray($apiResponse->getResponse());
	}

    public function detachProductFromMainProduct(Product $product, $params=[]): ?Product
    {
        $apiResponse = $this->getAPIResponse('cineville/products/'.$product->getId().'/attach',$params,'DELETE');
        return Product::getFromArray($apiResponse->getResponse());
    }

}