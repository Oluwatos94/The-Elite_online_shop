<?php

namespace TeldsShop\controllers;
use TeldsShop\src\models\productsClass;

class MainPageController extends A_Controller
{

    CONST NUMBER_ITEMS_DISPLAYED_ON_HOME_PAGE = 12;

    /**
     * @return void
     */
    protected function indexAction(): void
    {
        $products = new productsClass();
        $productItems = $products->findAll();
        $productItems = array_slice($productItems, "0", self::NUMBER_ITEMS_DISPLAYED_ON_HOME_PAGE);
        $this->dataRendering['product'] = $productItems;
        $this->dataRendering[''] = true;
        echo $this->view->render('index', $this->dataRendering);

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

    protected function pageNotFoundAction(): void
    {
        $this->dataRendering["pageTitle"] = 'Page not found!';
        echo $this->view->render('404', $this->dataRendering);
    }
}