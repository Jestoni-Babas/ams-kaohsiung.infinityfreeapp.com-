<?php
header('Content-Type: application/json; charset=utf-8');
include 'Dbh.php';

class UserModel {

    private $pdo;

    public function __construct() {
        $db = new Dbh();
        $this->pdo = $db->connect();
    }

    public function isEmailExist($email) {

        $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);

        return $stmt->fetchColumn() > 0;

    }

    public function createUser($username, $email, $hashedPwd) {

        if($this->isEmailExist($email)){
            return [
                "status" => "error",
                "message" => "Email already exist!"
            ];
        }

            try {
                $stmt = $this->pdo->prepare(
                    "INSERT INTO users (username, email, password) VALUES (?, ?, ?)"
                );

                $stmt->execute([$username, $email, $hashedPwd]);

                
                return [
                    "status" => "success",
                    "message" => "User saved successfully"
                ];

            } catch (PDOException $e) {
                return [
                    "status" => "error",
                    "message" => [$e->getMessage()]
                ];
            }
        }

    public function checkUser($email, $pwd) {

        try {
            $stmt = $this->pdo->prepare(
                "SELECT * FROM users WHERE email = ? LIMIT 1"
            );
            $stmt->execute([$email]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                return [
                    "status" => "error",
                    "message" => "Invalid email or password"
                ];
            }

            if (!password_verify($pwd, $user['password'])) {
                return [
                    "status" => "error",
                    "message" => "Invalid email or password"
                ];
            }

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            session_regenerate_id(true);

            $_SESSION['userName'] = $user['username'];
            $_SESSION['userId'] = $user['id'];
            $_SESSION['userEmail'] = $user['email'];

            return [
                "status" => "success",
                "message" => "Login successful"
            ];

        } catch (PDOException $e) {

            return [
                "status" => "error",
                "message" => "Something went wrong"
            ];
        }
    }
}