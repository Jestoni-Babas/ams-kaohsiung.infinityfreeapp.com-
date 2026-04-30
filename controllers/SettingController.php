<?php
header('Content-Type: application/json; charset=utf-8');

require './model/SettingModel.php';

class SettingController  {

    private $settingModel;

    public function __construct(){
        $this->settingModel = new SettingModel();
    }

    public function locale_insert(){
        $add_locale = $_POST['add_locale'] ?? '';

        if(empty($add_locale)){
            echo json_encode([
                "status" => "error",
                "message" => "This field is required!"
            ]);
            return;
        }
        $up = strtoupper($add_locale);
        $result = $this->settingModel->add_locale($up);
        echo json_encode($result);
    }

    public function locale_list(){
        
        $result = $this->settingModel->get_locale_list();

        echo json_encode($result);
    }

    public function locale_edit(){

        $id = $_POST['id'] ?? '';
        $locale_name = $_POST['locale_name'] ?? '';

        
        $text = strtoupper($locale_name);

        if(empty($locale_name)){
            echo json_encode([
                "status" => "error",
                "message" => "Please fill up the required field!"
            ]);
            return;
        }

        $result = $this->settingModel->edit_locale($id, $text);
        echo json_encode($result);

    }

    public function locale_delete(){
        $id = $_POST['id'] ?? '';

        if(empty($id)){
            echo json_encode([
                "status" => "error",
                "message" => "No data found!"
            ]);
            return;
        }
        $result = $this->settingModel->delete_locale($id);
        echo json_encode($result);
    }

    public function get_locales(){

        $result = $this->settingModel->get_locale_list();
        echo json_encode($result);

    }

}