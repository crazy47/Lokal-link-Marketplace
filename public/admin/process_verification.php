<?php
session_start();
require_once '../includes/db.php';

if ($_SESSION['user_type'] !== 'admin') { exit("Unauthorized"); }

$id = $_GET['id'] ?? null;
$status = $_GET['status'] ?? null;

if ($id && in_array($status, ['verified', 'rejected'])) {
    $stmt = $pdo->prepare("UPDATE tbl_producerprofiles SET verified_status = ? WHERE producer_id = ?");
    $stmt->execute([$status, $id]);
}
header("Location: dashboard.php");
exit();