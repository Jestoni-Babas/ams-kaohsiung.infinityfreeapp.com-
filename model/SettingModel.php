<?php
header('Content-Type: application/json; charset=utf-8');

include './model/Dbh.php';

class SettingModel {
    private $pdo;

    public function __construct() {
        $db = new Dbh();
        $this->pdo = $db->connect();
    }

    function isDuplicate($locale_name){
        $q = "SELECT COUNT(*) FROM locale WHERE locale_name=?";
        $stm = $this->pdo->prepare($q);
        $stm->execute([$locale_name]);

        return $stm->fetchColumn() > 0;
    }

    public function add_locale($add_locale){

        if($this->isDuplicate($add_locale)){
            return [
                "status" => "error",
                "message" => "Locale name duplication! <b>".ucfirst($add_locale)."</b> is already exist!"
            ];
        } else {
            try {
                $q = "INSERT INTO locale(locale_name) VALUES(?)";
                $stm = $this->pdo->prepare($q);

                if(!$stm){
                    return [
                        "status" => "error",
                        "message" => "Prepare failed!"
                    ];
                }

                $text = ucfirst($add_locale);

                $success = $stm->execute([$text]);

                if(!$success){
                    return [
                        "status" => "error",
                        "message" => "Execution failed!"
                    ];
                }

                return [
                    "status" => "success",
                    "message" => "Save success!"
                ];

            } catch(PDOException $e) {
                return [
                    "status" => "error",
                    "message" => $e->getMessage()
                ];
            }
        }
    }

    public function get_locale_list(){
        $q = "SELECT * FROM locale ORDER BY locale_name ASC";
        $stm = $this->pdo->prepare($q);
        $stm->execute();

        $rows = $stm->fetchAll(PDO::FETCH_ASSOC);

        if(count($rows) > 0){
            return [
                "status" => "success",
                "count" => count($rows),
                "data" => $rows
            ];
        } else {
            return [
                "status" => "empty",
                "count" => 0,
                "data" => [],
                "message" => "No data found!"
            ];
        }

    }

    public function edit_locale($id, $locale_name){

        $name = ucfirst($locale_name);

        $q = "UPDATE locale SET locale_name = ? WHERE id = ?";
        $stm = $this->pdo->prepare($q);
        $success = $stm->execute([
                    $name,
                    $id
                ]);

        if($success){
            return [
                "status" => "success",
                "message" => "Successfully updated!",
            ];
        } else {
            return [
                "status" => "error",
                "message" => "Update failed!"
            ];
        }
    }

    public function delete_locale($id){

        $q = "DELETE FROM locale WHERE id = ?";
        $stm = $this->pdo->prepare($q);
        $result = $stm->execute([$id]);

        if($result){
            return [
                "status" => "success",
                "message" => "Locale successfully deleted!"
            ];
        } else {
            return [
                "status" => "error",
                "message" => "Server error!"
            ];
        }



    }


}

