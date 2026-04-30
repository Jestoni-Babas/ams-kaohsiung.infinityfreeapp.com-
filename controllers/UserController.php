<?php
require_once 'model/Dbh.php';
require_once 'model/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $db = new Dbh();
        $pdo = $db->connect();

        $this->userModel = new UserModel($pdo);
    }

    
}