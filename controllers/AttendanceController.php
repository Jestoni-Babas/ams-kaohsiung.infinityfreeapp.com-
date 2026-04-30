<?php
header('Content-Type: application/json; charset=utf-8');

require './model/AttendanceModel.php';

class AttendanceController {

    private $attendanceModel;

    public function __construct() {
        $this->attendanceModel = new AttendanceModel();
    }

    public function attendance_log() {

        $input = json_decode(file_get_contents("php://input"), true);
        $qrCodeMessage = $input['qr'] ?? null;
        $gathering_type = $input['gathering_type'] ?? null;

        if (!$qrCodeMessage || !$gathering_type) {
            echo json_encode([
                "status" => "error",
                "message" => "No QR data received or Gathering type missing"
            ]);
            return;
        }

        if (strpos($qrCodeMessage, "MEMBER:") !== 0) {
            echo json_encode([
                "status" => "error",
                "message" => "Invalid QR format"
            ]);
            return;
        }

        $member_id = str_replace("MEMBER:", "", $qrCodeMessage);

        $result = $this->attendanceModel->attendance_insert($member_id, $gathering_type);

        echo json_encode($result);
    }
}