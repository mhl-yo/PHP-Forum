<?php

class AccountController extends BaseController
{
    private $db;

    public function onInit()
    {
        $this->db = new AccountModel();
    }

    public function register()
    {
        if ($this->isPost) {
            $username = $_POST['username'];
            if ($username == NULL || strlen($username) < 2) {
                //TODO: Error message
                $this->redirect("account", "register");
            }

            $password = $_POST['password'];
            $fName = $_POST['fName'];
            $lName = $_POST['lName'];
            $email = $_POST['email'];

            $isRegistered = $this->db->register($username, $password, $fName, $lName, $email);

            if ($isRegistered) {
                $_SESSION['username'] = $username;
                $_SESSION['userId'] = $username;
                //TODO: success message
                $this->redirect("questions", "index");
            } else {
                //TODO: Error message
                echo("Error register");
            }
        }

        //$this->db->register();
        $this->renderView(__FUNCTION__);
    }

    public function login()
    {
        if ($this->isPost) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $isLogedIn = $this->db->login($username, $password);

            if ($isLogedIn) {
                $_SESSION['username'] = $username;
                //TODO: Success message
                return $this->redirect("questions", "index");
            } else {
                //TODO: Error message
                $this->redirect("account", "login");
            }
        }
        $this->renderView(__FUNCTION__);
    }

    public function logout()
    {
        unset($_SESSION['username']);
        //$this->isLoggedIn = false;
        //TODO: Info message
        $this->redirectToUrl("/");
    }
}