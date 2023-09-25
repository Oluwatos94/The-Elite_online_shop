<?php

namespace TeldsShop\controllers;

use TeldsShop\models\usersClass;

class UsersAction extends A_Controller
{

    protected function indexAction(): void
    {
        $this->checkLogin();
        $this->view->render('index', $this->dataRendering);
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
        $this->checkLogin();

        $userData = $this->userDataValidationAndAssignment();

        if(!empty($userData)) {
            $instanceOfUsersClass = new usersClass();
            $result = $instanceOfUsersClass->insert($userData);
            if($result === true){
                $_SESSION['SuccessMessage'] = "You have successfully created your account, please kindly login!";
                header("Location: /login");
            } else {
                $this->dataRendering['error'] = "Registration failed, please try again";
                echo $this->view->render('registrationPage', $this->dataRendering);
            }
            } else {
            $_SESSION['errorMessage'] = "Please input a valid data";
            header("Location: /register");
        }
    }

    protected function userAuthenticateAction(): void
    {
        $_SESSION['userLoginFailed'] = false;
        $userEmail = $this->userEmailVerificationAction();
        $user = new usersClass();
        $userData = $user->findByEmail($userEmail);
        if(empty($userData)){
            $_SESSION['errorMessage'] = "This user with this email does not exist";
            header("Location: /login");
        } else {
            $this->userPasswordVerification($userData);
        }
    }
    protected function userEmailVerificationAction(): string
    {
        $userEmail = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        if(!$userEmail){
            $_SESSION['errorMessage'] = "Invalid email, input a valid email.";
            header("Location: /login");
        }
        return $userEmail;
    }
    protected function userLoginAction(): void
    {
        $this->dataRendering["page_title"] = 'Login';
        $userLoginFailed = $_SESSION['userLoginFailed'] ?? false;
        if ($userLoginFailed) {
            $this->dataRendering['error'] = $_SESSION['errorMessage'] ?? "Authentication failed! Please try again!";
        }

        if (!empty($_SESSION['successMessage'])) {
            $this->dataRendering['success'] = $_SESSION['successMessage'];
        }
        echo $this->view->render('login', $this->dataRendering);
    }
    protected function userLogoutAction(): void
    {
        unset($_SESSION['user']);
        session_destroy();
        header("Location: /login");
    }
    protected function userDataValidationAndAssignment(): array
    {
        $userData = [];
        if ($userData[usersClass::DB_FIELD_EMAIL] = filter_var($_POST[usersClass::DB_FIELD_EMAIL], FILTER_VALIDATE_EMAIL)) {
            $userData[usersClass::DB_FIELD_ADDRESS] = htmlentities($_POST[usersClass::DB_FIELD_ADDRESS]);
            $userData[usersClass::DB_FIELD_PASSWORD] = htmlentities($_POST[usersClass::DB_FIELD_PASSWORD]);
            $userData[usersClass::DB_FIELD_PASSWORD] = password_hash($userData[usersClass::DB_FIELD_PASSWORD], PASSWORD_DEFAULT);
        }

        return $userData;

    }
    protected function userPasswordVerification(array $userData): void
    {
        if(!password_verify($_POST['password'], $userData['password'])){
            $_SESSION['errorMessage'] = "email and password do not exist";
            header("Location: /login");
        } else {
            $_SESSION['user'] = $userData;
            header("Location: /");
        }
    }
}