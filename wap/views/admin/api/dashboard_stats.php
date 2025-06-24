<?php
require_once('../../../config/db_connection.php');
header('Content-Type: application/json');

try {
    // 1. WAP Status Distribution (for pie chart)
    $stmt1 = $pdo->query("SELECT status, COUNT(*) as count FROM work_permits GROUP BY status");
    $statusCounts = $stmt1->fetchAll(PDO::FETCH_KEY_PAIR);

    // 2. WAPs by Department (bar chart)
    $stmt2 = $pdo->query("SELECT department, COUNT(*) as count FROM work_permits GROUP BY department");
    $deptCounts = $stmt2->fetchAll(PDO::FETCH_KEY_PAIR);

    // 3. Monthly WAP Submission Trends (line chart)
    $stmt3 = $pdo->query("
        SELECT MONTH(submitted_at) as month, COUNT(*) as count
        FROM work_permits
        WHERE YEAR(submitted_at) = YEAR(CURDATE())
        GROUP BY MONTH(submitted_at)
    ");
    $monthlyData = $stmt3->fetchAll();
    $months = [];
    $monthCounts = [];
    foreach ($monthlyData as $row) {
        $months[] = date('M', mktime(0, 0, 0, $row['month'], 1));
        $monthCounts[] = $row['count'];
    }

    // Helper for percentage trend
    function calculateTrend($current, $last) {
        if ($last > 0) {
            return round((($current - $last) / $last) * 100, 1);
        } elseif ($current > 0) {
            return 100;
        }
        return 0;
    }

    $currentMonth = (int) date('n');
    $lastMonth = $currentMonth === 1 ? 12 : $currentMonth - 1;
    $currentYear = (int) date('Y');
    $lastMonthYear = $currentMonth === 1 ? $currentYear - 1 : $currentYear;

    // 4. Total WAPs (submitted this month vs last)
    $stmtTotalNow = $pdo->prepare("SELECT COUNT(*) FROM work_permits WHERE MONTH(submitted_at) = ? AND YEAR(submitted_at) = ?");
    $stmtTotalLast = $pdo->prepare("SELECT COUNT(*) FROM work_permits WHERE MONTH(submitted_at) = ? AND YEAR(submitted_at) = ?");
    $stmtTotalNow->execute([$currentMonth, $currentYear]);
    $stmtTotalLast->execute([$lastMonth, $lastMonthYear]);
    $totalNow = (int) $stmtTotalNow->fetchColumn();
    $totalLast = (int) $stmtTotalLast->fetchColumn();
    $totalTrend = calculateTrend($totalNow, $totalLast);

    // 5. Pending WAPs (by submitted date)
    $stmtPendingNow = $pdo->prepare("SELECT COUNT(*) FROM work_permits WHERE status = 'pending' AND MONTH(submitted_at) = ? AND YEAR(submitted_at) = ?");
    $stmtPendingLast = $pdo->prepare("SELECT COUNT(*) FROM work_permits WHERE status = 'pending' AND MONTH(submitted_at) = ? AND YEAR(submitted_at) = ?");
    $stmtPendingNow->execute([$currentMonth, $currentYear]);
    $stmtPendingLast->execute([$lastMonth, $lastMonthYear]);
    $pendingNow = (int) $stmtPendingNow->fetchColumn();
    $pendingLast = (int) $stmtPendingLast->fetchColumn();
    $pendingTrend = calculateTrend($pendingNow, $pendingLast);

    // 6. Expired WAPs (by expiry_date in wap_approvals)
    $stmtExpiredNow = $pdo->prepare("
        SELECT COUNT(*) FROM wap_approvals 
        WHERE MONTH(expiry_date) = ? AND YEAR(expiry_date) = ? AND expiry_date < NOW()
    ");
    $stmtExpiredLast = $pdo->prepare("
        SELECT COUNT(*) FROM wap_approvals 
        WHERE MONTH(expiry_date) = ? AND YEAR(expiry_date) = ? AND expiry_date < NOW()
    ");
    $stmtExpiredNow->execute([$currentMonth, $currentYear]);
    $stmtExpiredLast->execute([$lastMonth, $lastMonthYear]);
    $expiredNow = (int) $stmtExpiredNow->fetchColumn();
    $expiredLast = (int) $stmtExpiredLast->fetchColumn();
    $expiredTrend = calculateTrend($expiredNow, $expiredLast);

    // 7. Expiring Soon (next 7 days)
    $stmtExpiringSoon = $pdo->query("
        SELECT COUNT(*) FROM wap_approvals
        WHERE expiry_date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY)
    ");
    $expiringSoon = (int) $stmtExpiringSoon->fetchColumn();

    echo json_encode([
        "status" => "success",
        "data" => [
            "statuses" => $statusCounts,
            "departments" => $deptCounts,
            "months" => $months,
            "monthCounts" => $monthCounts,
            "expiringSoon" => $expiringSoon,
            "totals" => [
                "total" => $totalNow,
                "pending" => $pendingNow,
                "expired" => $expiredNow,
                "trends" => [
                    "total" => $totalTrend,
                    "pending" => $pendingTrend,
                    "expired" => $expiredTrend
                ]
            ]
        ]
    ]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
