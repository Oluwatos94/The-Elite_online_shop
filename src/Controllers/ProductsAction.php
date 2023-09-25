<?php

namespace TeldsShop\Controllers;

use TeldsShop\App\Routing;
use TeldsShop\models\ProductsClass;

class ProductsAction extends A_Controller
{

    /**
     * @return void
     * this method instantiate the product class, finds all products
     * if found, it gets four random products and display to users.
     * Otherwise, it returns not found as response.
     */
    protected function indexAction(): void
    {
        $id = Routing::$urlIdPaths;
        $productsClassInstance = new productsClass();
        $allProducts = $productsClassInstance->findAll();
        if(empty($allProducts)){
            header("Location: /not found");
        }
        $this->dataRendering['products'] = $allProducts;
        //$this->dataRendering['products'] = $this->getRandomProduct(4);
        $this->dataRendering['products'] = $this->getRandomShuffleProduct(5);

        echo $this->view->render("index", $this->dataRendering);
    }

    protected function allProductsViewAction(): void
    {
        $productClassInstance = new productsClass();
        $allProducts = $productClassInstance->findAll();
        $this->dataRendering['Products'] = $allProducts;

        echo $this->view->render("allProducts", $this->dataRendering);
    }

    protected function deleteAction(): void
    {
        // TODO: Implement deleteAction() method.
    }

    protected function updateAction(): void
    {
        // TODO: Implement updateAction() method.
    }

    protected function addAction(): void
    {
        // TODO: Implement addAction() method.
    }

    private function getRandomProduct(int $numberOfProducts): array
    {
        $products = [];
        $product = new productsClass();
        $maxId = $product->maximumId();
        for($i = 0; $i < $numberOfProducts; $i++){
            $randMax = rand(1, $maxId);
            $products[] = $product->findById($randMax);
        }
        return $products;
    }
    private function getRandomShuffleProduct(int $numberOfProducts): ProductsClass
    {
        $products = new productsClass();
        $products = $products->findAll();
        shuffle($products);
        return array_slice($products, 0, $numberOfProducts);
    }
}
