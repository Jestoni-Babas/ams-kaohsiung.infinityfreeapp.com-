<?php
header('Content-Type: application/json; charset=utf-8');

require './model/UserModel.php';

class AuthController {

    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function register() {

        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $pwd = $_POST['pwd'] ?? '';
        $confirm_pwd = $_POST['confirm_pwd'] ?? '';

        $errors = [];

        // Validation
        if (empty($username)) {
            $errors[] = "Full name is required!";
        }
        if (empty($email)) {
            $errors[] = "Email is required!";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format!";
        }

        if (empty($pwd)) {
            $errors[] = "Password is required!";
        }

        if ($pwd !== $confirm_pwd) {
            $errors[] = "Passwords do not match!";
        }

        if (!empty($errors)) {
            echo json_encode([
                "status" => "error",
                "message" => $errors
            ]);
            return;
        }

        $result = $this->userModel->createUser($username, $email, password_hash($pwd, PASSWORD_ARGON2ID));

        echo json_encode($result);
    }

    public function login(){
        
        $email = $_POST['email'] ?? '';
        $pwd = $_POST['pwd'] ?? '';

        $errors = [];

        if(empty($email)){
            $errors[] = "Email field is required!";
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[] = "Enter a valid email!";
        }

        if(empty($pwd)){
           $errors[] = "Enter your password!";
        }

        if(!empty($errors)){
            echo json_encode([
                "status" => "error",
                "message" => $errors
            ]);
            return;
        }


        $result = $this->userModel->checkUser($email, $pwd);

        echo json_encode($result);
    }
}