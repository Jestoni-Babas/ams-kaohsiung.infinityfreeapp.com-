<?php
header('Content-Type: application/json; charset=utf-8');

include './model/Dbh.php';

class GatheringModel {
    private $pdo;

    public function __construct() {
        $db = new Dbh();
        $this->pdo = $db->connect();
    }

    function isDuplicate($gathering_name){
        $q = "SELECT COUNT(*) FROM gatherings WHERE gathering_name=?";
        $stm = $this->pdo->prepare($q);
        $stm->execute([$gathering_name]);

        return $stm->fetchColumn() > 0;
    }

    public function add_gathering($add_gathering){

        if($this->isDuplicate($add_gathering)){
            return [
                "status" => "error",
                "message" => "Gathering type  duplication! <b>".ucfirst($add_gathering)."</b> is already exist!"
            ];
        } else {
            try {
                $q = "INSERT INTO gatherings(gathering_name) VALUES(?)";
                $stm = $this->pdo->prepare($q);

                if(!$stm){
                    return [
                        "status" => "error",
                        "message" => "Prepare failed!"
                    ];
                }

                $text = ucfirst($add_gathering);

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

    public function get_gathering_list(){
        $q = "SELECT * FROM gatherings ORDER BY gathering_name ASC";
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
            exit;
        }

    }

    public function edit_gathering($id, $gathering_name){

        $name = ucfirst($gathering_name);

        $q = "UPDATE gatherings SET gathering_name = ? WHERE id = ?";
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

    public function delete_gathering($id){

        $q = "DELETE FROM gatherings WHERE id = ?";
        $stm = $this->pdo->prepare($q);
        $result = $stm->execute([$id]);

        if($result){
            return [
                "status" => "success",
                "message" => "Gathering type successfully deleted!"
            ];
        } else {
            return [
                "status" => "error",
                "message" => "Server error!"
            ];
        }



    }


}

