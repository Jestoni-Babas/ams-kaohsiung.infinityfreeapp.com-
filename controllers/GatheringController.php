<?php
header('Content-Type: application/json; charset=utf-8');

require './model/GatheringModel.php';

class GatheringController  {

    private $gatheringModel;

    public function __construct(){
        $this->gatheringModel = new GatheringModel();
    }

    public function gathering_insert(){
        $add_gathering = $_POST['add_gathering'] ?? '';

        if(empty($add_gathering)){
            echo json_encode([
                "status" => "error",
                "message" => "This field is required!"
            ]);
            return;
        }

        $result = $this->gatheringModel->add_gathering($add_gathering);
        echo json_encode($result);
    }

    public function gathering_list(){
        
        $result = $this->gatheringModel->get_gathering_list();

        echo json_encode($result);
    }

    public function gathering_edit(){

        $id = $_POST['id'] ?? '';
        $gathering_name = $_POST['gathering_name'] ?? '';

        if(empty($gathering_name)){
            echo json_encode([
                "status" => "error",
                "message" => "Please fill up the required field!"
            ]);
            return;
        }

        $result = $this->gatheringModel->edit_gathering($id, $gathering_name);
        echo json_encode($result);

    }

    public function gathering_delete(){
        $id = $_POST['id'] ?? '';

        if(empty($id)){
            echo json_encode([
                "status" => "error",
                "message" => "No data found!"
            ]);
            return;
        }
        $result = $this->gatheringModel->delete_gathering($id);
        echo json_encode($result);
    }

}