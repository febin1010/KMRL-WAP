<?php
require 'db_connection.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $licensee_name = $_POST['licensee'];
    $loa_no = $_POST['loa'];
    $office_no = $_POST['office_no'];
    $official_name = $_POST['official'];
    $official_mobile = $_POST['official_mobile'];
    $scope_of_business = $_POST['scope'];
    $proposed_station = $_POST['station'];
    $proposed_location = $_POST['location'];
    $description = $_POST['description'];
    $proposed_duration = $_POST['duration'];
    $details_of_tools = $_POST['tools'];
    $competent_supervisor = $_POST['competent_sup'];
    $competent_engineer = $_POST['competent_eng'];
    $engineer_mobile = $_POST['eng_mobile'];
    $number_of_workers = $_POST['workers'];
    $authorized_rep1 = $_POST['auth_name1'];
    $authorized_rep2 = $_POST['auth_name2'];
    $work_mode = isset($_POST['workMode']) ? implode(',', $_POST['workMode']) : '';

    // File upload handling
    $uploadDir = "uploads/";
    $filePath = "";
    if (!empty($_FILES["attachments"]["name"])) {
        $fileName = basename($_FILES["attachments"]["name"]);
        $filePath = $uploadDir . $fileName;
        move_uploaded_file($_FILES["attachments"]["tmp_name"], $filePath);
    }

    // Insert into database
    $query = "INSERT INTO work_permits 
                (licensee_name, loa_no, office_no, official_name, official_mobile, scope_of_business, proposed_station, proposed_location, description, proposed_duration, details_of_tools, competent_supervisor, competent_engineer, engineer_mobile, number_of_workers, authorized_rep1, authorized_rep2, work_mode, attachments) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssssssssssssss", $licensee_name, $loa_no, $office_no, $official_name, $official_mobile, $scope_of_business, $proposed_station, $proposed_location, $description, $proposed_duration, $details_of_tools, $competent_supervisor, $competent_engineer, $engineer_mobile, $number_of_workers, $authorized_rep1, $authorized_rep2, $work_mode, $filePath);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Work Permit Submitted Successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>
