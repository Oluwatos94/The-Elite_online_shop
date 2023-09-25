<?php

namespace TeldsShop\Controllers;

use TeldsShop\App\Routing;
use TeldsShop\models\CartsClass;
use TeldsShop\models\ProductsClass;

class CartAction extends A_Controller
{

    /**
     * @return void
     * This method creates an instance of the cart, find all items in cart ordered by user
     * And display all item to users
     */
    protected function indexAction(): void
    {
        $this->checkLogin();

        $instanceOfCartClass = new CartsClass();
        $cartItem = $instanceOfCartClass->findCartByUserIdJoinWithProducts($_SESSION['user']['id']);
        $this->dataRendering['items'] = $cartItem;
        $this->view->render("cartList", $this->dataRendering);
    }

    /**
     * @return void
     * This method deletes all cart items.
     */
    protected function deleteCartAction(): void
    {
        $this->checkLogin();
        $id = Routing::$urlIdPaths;
        $instanceOfCartClass = new CartsClass();
        $deletedCart = $instanceOfCartClass->deleteCartByProductId($id);
        if ($deletedCart === true){
            $this->dataRendering['success'] = "Cart successfully deleted";
        }
        $this->dataRendering['error'] = "Deletion failed! Try again";
        header("Location: /cart");
    }

    protected function updateAction(): void
    {
        // TODO: Implement updateAction() method.
    }

    protected function addAction(): void
    {
        $this->checkLogin();
        $cartData[CartsClass::DB_FILED_PRODUCT_ID] = (int)(htmlentities($_POST['product_id']));
        $instanceOfProductsClass = new ProductsClass();
        $productData = $instanceOfProductsClass->findById($cartData[CartsClass::DB_FILED_PRODUCT_ID]);
        if(empty($productData)){
            header("Location: /not found");
        }
        $cartData[CartsClass::DB_FILED_QUANTITY] = htmlentities($_POST['quantity']);
        $cartData[CartsClass::DB_FILED_USER_ID] = $_SESSION['user']['id'];
        $instanceOfCartClass = new CartsClass();
        $result = $instanceOfCartClass->insertIntoCart($cartData);
        if($result === true){
            $this->dataRendering['success'] = "Items successfully added to cart";
            $this->getNumberOfItemsInCart();
        } else {
            $this->dataRendering['error'] = "Failed to add item to cart";
        }
        $this->dataRendering['products'] = $productData;
        echo $this->view->render("index", $this->dataRendering);
    }

    protected function checkoutAction(): void
    {
        $result = true;
        $this->checkLogin();
        $instanceOfCartClass = new CartsClass();
        $cartItems = $instanceOfCartClass->findCartByUserId($_SESSION['user']['id']);
        if(!empty($cartItems)){
            foreach($cartItems as $item)
            {
                $cartId = $item['id'];
                $result &= $instanceOfCartClass->updateToCartCheckout($cartId);
            }
        }
        if($result){
            header("Location: /Thank you!");
        }
        $this->dataRendering['error'] = "Checkout could not be completed! Please try again.";
        header("Location: /cart");
    }

    protected function thankYouAction(): void
    {
        $this->checkLogin();
        $this->view->render("thankYouPage", $this->dataRendering);
    }

    protected function deleteAction(): void
    {
        // TODO: Implement deleteAction() method.
    }
}
