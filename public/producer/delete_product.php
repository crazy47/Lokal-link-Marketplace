<?php
session_start();
require_once '../includes/db.php';

// 1. Security Check
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'producer') {
    header("Location: ../auth/login.php");
    exit();
}

// 2. Delete Logic
if (isset($_GET['id'])) {
    try {
        $stmt = $pdo->prepare("DELETE FROM tbl_products WHERE product_id = ?");
        $stmt->execute([$_GET['id']]);
        header("Location: manage-products.php?success=deleted");
    } catch (PDOException $e) {
        // If an order already exists for this product, you might get a constraint error
        die("Error: This product is linked to an existing order and cannot be deleted.");
    }
} else {
    header("Location: manage-products.php");
}
exit();