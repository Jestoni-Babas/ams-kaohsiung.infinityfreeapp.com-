<?php
header('Content-Type: application/json; charset=utf-8');

include './model/Dbh.php';

class ProfileModel {
    private $pdo;

    public function __construct() {
        $db = new Dbh();
        $this->pdo = $db->connect();
    }

    function isDuplication($church_id){
        $q = "SELECT COUNT(*) FROM profiles WHERE church_id=?";
        $stm = $this->pdo->prepare($q);
        $stm->execute([
            $church_id
        ]);

        return $stm->fetchColumn() > 0;
    }


    public function profile_add($lname, $fname, $mname, $church_id, $locale, $filename, $dob) {


        if($this->isDuplication($church_id)){
            return [
                "status" => "error",
                "message" => "Church ID already exist!"
            ];
        }

        try {

                if($filename === null){
                    $picture = 'MCGI-LOGO.png';
                        $q = "INSERT INTO profiles(lname, fname, mname, church_id, locale, picture, dob)
                            VALUES(?,?,?,?,?,?,?)";
                        $stm = $this->pdo->prepare($q);
                        $ex = $stm->execute([
                            $lname,
                            $fname,
                            $mname,
                            $church_id,
                            $locale,
                            $picture,
                            $dob
                        ]);

                        if(!$ex){
                            return [
                                "status" => "error",
                                "message" => "Insertion failed!"
                            ];
                        } else {
                            return [
                                "status" => "success",
                                "message" => "Profile added successfully!"
                            ];
                        }
                } else {

                    if (empty($filename['name']) || $filename['error'] === UPLOAD_ERR_NO_FILE) {
                        $newfilename = 'MCGI-LOGO.png';
                    } else {

                        $picture = $filename['name'];

                        $allowedTypes = array("jpeg", "jpg", "png");
                        $ext = strtolower(pathinfo($picture, PATHINFO_EXTENSION));

                        if (!in_array($ext, $allowedTypes)) {
                            return [
                                "status" => "error",
                                "message" => "Invalid file format! Only JPG and PNG allowed."
                            ];
                        }

                        $newfilename = uniqid() . '.' . $ext;

                        if (!move_uploaded_file($filename['tmp_name'], './src/pictures/' . $newfilename)) {
                            return [
                                "status" => "error",
                                "message" => "Upload failed"
                            ];
                        }
                    }

                    $q = "INSERT INTO profiles(lname, fname, mname, church_id, locale, picture, dob)
                        VALUES(?,?,?,?,?,?,?)";
                    $stm = $this->pdo->prepare($q);
                    $ex = $stm->execute([
                        $lname,
                        $fname,
                        $mname,
                        $church_id,
                        $locale,
                        $newfilename,
                        $dob
                    ]);

                    if(!$ex){
                        return [
                            "status" => "error",
                            "message" => "Insertion failed!"
                        ];
                    } else {
                        return [
                            "status" => "success",
                            "message" => "Profile added successfully!"
                        ];
                    }
                }
        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => $e->getMessage()
            ];
        }
    }

    public function getLoadMinProfiles(){
        try {

            $q = "SELECT * FROM profiles ORDER BY id DESC LIMIT 10";
            $stm = $this->pdo->prepare($q);
            $stm->execute();

            $rows = $stm->fetchAll(PDO::FETCH_ASSOC);

            if(count($rows) < 1){
                return [
                    "status" => "error",
                    "message" => "No data found!"
                ];
            }

            return [
                "status" => "success",
                "profile" => $rows
            ];

        } catch(PDOException $e) {
            return [
                "status" => "error",
                "message" => $e->getMessage()
            ];
        }
    }

}