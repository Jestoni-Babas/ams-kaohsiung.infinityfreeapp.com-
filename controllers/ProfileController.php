<?php
header('Content-Type: application/json; charset=utf-8');

require './model/ProfileModel.php';

class ProfileController  {

    private $profileModel;

    public function __construct(){
        $this->profileModel = new ProfileModel();
    }

    
    public function profile_insert(){

        $lname = $_POST['lname'] ?? '';
        $fname = $_POST['fname'] ?? '';
        $mname = $_POST['mname'] ?? '';
        $church_id = $_POST['church_id'] ?? '';
        $locale = $_POST['locale'] ?? '';
        $dob = $_POST['dob'] ?? '';
        $picture = $_FILES['picture'];

        if (
            empty($lname) || empty($fname) || empty($church_id) ||
            empty($locale) || empty($dob)
        ) {
            echo json_encode([
                "status" => "error",
                "message" => "All required fields must be filled"
            ]);
            return;
        }

        $result = $this->profileModel->profile_add(
            $lname,
            $fname,
            $mname,
            $church_id,
            $locale,
            $picture,
            $dob
        );

        echo json_encode($result);
    }

    public function loadMinimumProfiles(){
        
        $result = $this->profileModel->getLoadMinProfiles();
        echo json_encode($result);
        
    }


}