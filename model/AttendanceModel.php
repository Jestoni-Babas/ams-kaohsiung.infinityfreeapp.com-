    <?php
    header('Content-Type: application/json; charset=utf-8');

    include './model/Dbh.php';

    class AttendanceModel {

        private $pdo;

        public function __construct() {
            $db = new Dbh();
            $this->pdo = $db->connect();
        }

        function getData($church_id){
            $q = "SELECT * FROM profiles WHERE church_id = ?";
            $stm = $this->pdo->prepare($q);
            $stm->execute([$church_id]);

            $row = $stm->fetch(PDO::FETCH_ASSOC);

            return [
                "status" => "success",
                "info" => $row
            ];
        }

        public function attendance_insert($church_id, $gathering_type) {

            $q = "SELECT * FROM profiles WHERE church_id = ? LIMIT 1";
            $stm = $this->pdo->prepare($q);
            $stm->execute([$church_id]);

            $row = $stm->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                return [
                    "status" => "error",
                    "message" => "No data found!"
                ];
            }

            $q = "INSERT INTO attendance_logs(church_id, gathering_type, time_in) VALUES(?, ?, NOW())";
            $stm = $this->pdo->prepare($q);
            $result = $stm->execute([
                $row['church_id'],
                $gathering_type
                ]);

            if (!$result) {
                return [
                    "status" => "error",
                    "message" => "Insertion failed!"
                ];
            }

            return $this->getData($church_id);

            // return [
            //     "status" => "success",
            //     "message" => "Inserted!"
            // ];
        }
    }