<?php
error_log(print_r($_POST, true));
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");

require 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    exit;
}

// Debugging: Log received POST and FILES data
error_log(print_r($_POST, true));
error_log(print_r($_FILES, true));

// Collect form data
$licensee_name = $_POST['licensee'] ?? null;
$loa_no = $_POST['loa'] ?? null;
$office_no = $_POST['office_no'] ?? null;
$official_name = $_POST['official'] ?? null;
$official_mobile = $_POST['official_mobile'] ?? null;
$scope_of_business = $_POST['scope'] ?? null;
$proposed_station = $_POST['station'] ?? null;
$proposed_location = $_POST['location'] ?? null;
$description = $_POST['description'] ?? null;
$proposed_duration = $_POST['duration'] ?? null;
$details_of_tools = $_POST['tools'] ?? null;
$competent_supervisor = $_POST['competent_sup'] ?? null;
$competent_engineer = $_POST['competent_eng'] ?? null;
$engineer_mobile = $_POST['eng_mobile'] ?? null;
$number_of_workers = $_POST['workers'] ?? null;
$authorized_rep1 = $_POST['auth_name1'] ?? null;
$authorized_rep2 = $_POST['auth_name2'] ?? null;
$work_mode = isset($_POST['workMode']) ? (is_array($_POST['workMode']) ? implode(',', $_POST['workMode']) : $_POST['workMode']) : null;

// Debug: Log processed values
error_log(print_r([
    'licensee_name' => $licensee_name,
    'loa_no' => $loa_no,
    'office_no' => $office_no,
    'official_name' => $official_name,
    'official_mobile' => $official_mobile,
    'scope_of_business' => $scope_of_business,
    'proposed_station' => $proposed_station,
    'proposed_location' => $proposed_location,
    'description' => $description,
    'proposed_duration' => $proposed_duration,
    'details_of_tools' => $details_of_tools,
    'competent_supervisor' => $competent_supervisor,
    'competent_engineer' => $competent_engineer,
    'engineer_mobile' => $engineer_mobile,
    'number_of_workers' => $number_of_workers,
    'authorized_rep1' => $authorized_rep1,
    'authorized_rep2' => $authorized_rep2,
    'work_mode' => $work_mode
], true));

// File upload handling
$uploadDir = "uploads/";
$filePath = null;

if (!empty($_FILES["attachments"]["name"])) {
    if ($_FILES["attachments"]["error"] !== UPLOAD_ERR_OK) {
        echo json_encode(["status" => "error", "message" => "File upload failed: " . $_FILES["attachments"]["error"]]);
        exit;
    }

    $fileName = time() . "_" . basename($_FILES["attachments"]["name"]); // Unique file name
    $filePath = $uploadDir . $fileName;

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (!move_uploaded_file($_FILES["attachments"]["tmp_name"], $filePath)) {
        echo json_encode(["status" => "error", "message" => "Failed to save uploaded file."]);
        exit;
    }
}

try {
    $query = "INSERT INTO work_permits 
                (licensee_name, loa_no, office_no, official_name, official_mobile, scope_of_business, 
                proposed_station, proposed_location, description, proposed_duration, details_of_tools, 
                competent_supervisor, competent_engineer, engineer_mobile, number_of_workers, authorized_rep1, 
                authorized_rep2, work_mode, attachments, submitted_at) 
              VALUES 
                (:licensee_name, :loa_no, :office_no, :official_name, :official_mobile, :scope_of_business, 
                :proposed_station, :proposed_location, :description, :proposed_duration, :details_of_tools, 
                :competent_supervisor, :competent_engineer, :engineer_mobile, :number_of_workers, :authorized_rep1, 
                :authorized_rep2, :work_mode, :attachments, NOW())";

    $stmt = $pdo->prepare($query);
    
    $stmt->execute([
        ':licensee_name' => $licensee_name,
        ':loa_no' => $loa_no,
        ':office_no' => $office_no,
        ':official_name' => $official_name,
        ':official_mobile' => $official_mobile,
        ':scope_of_business' => $scope_of_business,
        ':proposed_station' => $proposed_station,
        ':proposed_location' => $proposed_location,
        ':description' => $description,
        ':proposed_duration' => $proposed_duration,
        ':details_of_tools' => $details_of_tools,
        ':competent_supervisor' => $competent_supervisor,
        ':competent_engineer' => $competent_engineer,
        ':engineer_mobile' => $engineer_mobile,
        ':number_of_workers' => $number_of_workers,
        ':authorized_rep1' => $authorized_rep1,
        ':authorized_rep2' => $authorized_rep2,
        ':work_mode' => $work_mode,
        ':attachments' => $filePath
    ]);

    echo json_encode(["status" => "success", "message" => "Work Permit Submitted Successfully"]);
} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
    exit;
}
?>
