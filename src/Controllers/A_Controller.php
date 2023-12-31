<?php

namespace TeldsShop\Controllers;
use TeldsShop\App\View;
use TeldsShop\models\CartsClass;

abstract class A_Controller implements I_Controller
{
    protected View $view;
    protected array $dataRendering = [];
    public function __construct(View $view)
    {
        $this->view = $view;
        $this->dataRendering['page_title'] = ["Welcome to your home of shopping"];
    }

    public function __call($name, $args)
    {
        if (method_exists($this, $name)) {
            //Input data validation

            $this->view->setActionNameForViews(str_replace('Action', '', $name));
            $classNameSpaceWithName = get_class($this);
            $className = str_replace('TeldsShop\\Controllers\\', '', $classNameSpaceWithName);
            $this->view->setClassNameForViews(str_replace('Controller', '', $className));
            return call_user_func_array(array($this, $name), $args);
        }
    }

    abstract protected function indexAction(): void;
    abstract protected function deleteAction(): void;
    abstract protected function updateAction(): void;
    abstract protected function addAction(): void;

    public function checkLogin(): void
    {
        if(!isset($_SESSION['user']) || empty($_SEESION['user']))
        {
            header('Location: /login');
        }
    }

    public function dataInputValidation(): void
    {
        if (!empty($_POST))
        {
            foreach ($_POST as $key => $value)
            {
                $value = filter_input(INPUT_POST, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $value = htmlspecialchars($value);
                $_POST[$key] = $value;
            }
        }
    }

    public function getNumberOfItemsInCart(): void
    {
        $InstanceOfCart = new CartsClass();
        $NumberOfItemsInCart = count($InstanceOfCart->findCartByUserId($_SESSION['user']['id'] ?? 0));
        $this->dataRendering['QtyInCart'] = $NumberOfItemsInCart;
    }
}
