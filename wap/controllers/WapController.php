<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../config/db_connection.php';
require_once __DIR__ . '/../vendor/autoload.php';

class WapController {
    public function submitWapForm() {
        session_start();
        header("Content-Type: application/json");

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            http_response_code(405);
            echo json_encode(["status" => "error", "message" => "Invalid request method"]);
            exit;
        }

        try {
            global $pdo;

            // Sanitize and fetch input
            $fields = [
                'licensee', 'loa', 'office_no', 'official', 'official_mobile', 'scope',
                'station', 'location', 'description', 'duration', 'tools', 'competent_sup',
                'competent_eng', 'eng_mobile', 'workers', 'auth_name1', 'auth_name2'
            ];
            $data = [];
            foreach ($fields as $field) {
                $data[$field] = trim($_POST[$field] ?? '') ?: null;
            }

            $work_mode = isset($_POST['workMode']) ? (is_array($_POST['workMode']) ? implode(',', $_POST['workMode']) : $_POST['workMode']) : null;

            // Handle file upload
            $uploadDir = __DIR__ . '/../assets/uploads/';
            $filePath = null;
            if (!empty($_FILES["attachments"]["name"])) {
                if ($_FILES["attachments"]["error"] !== UPLOAD_ERR_OK) {
                    throw new Exception("File upload failed.");
                }

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $filename = time() . "_" . basename($_FILES["attachments"]["name"]);
                $targetPath = $uploadDir . $filename;

                if (!move_uploaded_file($_FILES["attachments"]["tmp_name"], $targetPath)) {
                    throw new Exception("Failed to save uploaded file.");
                }

                $filePath = 'assets/uploads/' . $filename;
            }

            // Insert into DB
            $stmt = $pdo->prepare("INSERT INTO work_permits 
                (licensee_name, loa_no, office_no, official_name, official_mobile, scope_of_business,
                 proposed_station, proposed_location, description, proposed_duration, details_of_tools,
                 competent_supervisor, competent_engineer, engineer_mobile, number_of_workers, authorized_rep1,
                 authorized_rep2, work_mode, attachments, submitted_at)
                VALUES
                (:licensee, :loa, :office_no, :official, :official_mobile, :scope,
                 :station, :location, :description, :duration, :tools,
                 :competent_sup, :competent_eng, :eng_mobile, :workers, :auth_name1,
                 :auth_name2, :work_mode, :attachments, NOW())");

            $stmt->execute([
                ':licensee' => $data['licensee'],
                ':loa' => $data['loa'],
                ':office_no' => $data['office_no'],
                ':official' => $data['official'],
                ':official_mobile' => $data['official_mobile'],
                ':scope' => $data['scope'],
                ':station' => $data['station'],
                ':location' => $data['location'],
                ':description' => $data['description'],
                ':duration' => $data['duration'],
                ':tools' => $data['tools'],
                ':competent_sup' => $data['competent_sup'],
                ':competent_eng' => $data['competent_eng'],
                ':eng_mobile' => $data['eng_mobile'],
                ':workers' => $data['workers'],
                ':auth_name1' => $data['auth_name1'],
                ':auth_name2' => $data['auth_name2'],
                ':work_mode' => $work_mode,
                ':attachments' => $filePath
            ]);

            // Notify Civil Team
            $stmtNotify = $pdo->prepare("SELECT email, name FROM users WHERE role = 'civil'");
            $stmtNotify->execute();
            $civilUsers = $stmtNotify->fetchAll(PDO::FETCH_ASSOC);

            $subject = "New Work Access Permit Submitted – " . $data['station'];
            $body = "
                <h3>New Work Access Permit Submitted</h3>
                <table border='1' cellpadding='8' cellspacing='0' style='border-collapse: collapse;'>
                    <tr><td><strong>Licensee</strong></td><td>{$data['licensee']}</td></tr>
                    <tr><td><strong>Station</strong></td><td>{$data['station']}</td></tr>
                    <tr><td><strong>Location</strong></td><td>{$data['location']}</td></tr>
                    <tr><td><strong>Duration</strong></td><td>{$data['duration']} day(s)</td></tr>
                    <tr><td><strong>Submitted By</strong></td><td>{$data['official']}</td></tr>
                </table>
                <br>
                <a href='http://localhost/kmrl_app_wd/wap/views/auth/login.php' style='
                    background:#1a73e8;
                    color:#fff;
                    padding:10px 20px;
                    text-decoration:none;
                    border-radius:5px;'>Login to View</a>
            ";

            foreach ($civilUsers as $user) {
                $this->sendNotificationEmail($user['email'], $user['name'], $subject, $body);
            }

            echo json_encode([
                "status" => "success",
                "message" => "Work Permit Submitted Successfully",
            ]);
        } catch (Exception $e) {
            error_log("WAP Submission Error: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "An unexpected error occurred."]);
        }
    }

    private function sendNotificationEmail($toEmail, $toName, $subject, $body) {
        global $pdo;
        $mail = new PHPMailer(true);

        try {
            // SMTP Config
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';        // Replace with your SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'jobswipe3@gmail.com';   // Replace with your email
            $mail->Password   = 'ssct kgyn hksk ulcs';   // Use App Password or SMTP credentials
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('jobswipe3@gmail.com', 'KMRL WAP System');
            $mail->addAddress($toEmail, $toName);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();

            // Log Success
            $log = $pdo->prepare("INSERT INTO email_log (recipient_email, subject, message, status, sent_at) VALUES (?, ?, ?, ?, NOW())");
            $log->execute([$toEmail, $subject, $body, 'success']);
        } catch (Exception $e) {
            error_log("Mail Error ({$toEmail}): " . $mail->ErrorInfo);

            // Log Failure
            $log = $pdo->prepare("INSERT INTO email_log (recipient_email, subject, message, status, error_message, sent_at) VALUES (?, ?, ?, ?, ?, NOW())");
            $log->execute([$toEmail, $subject ?? '', $body ?? '', 'failure', $mail->ErrorInfo]);
        }
    }
}
