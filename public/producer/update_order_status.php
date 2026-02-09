<?php
session_start();
require_once '../includes/db.php';

// 1. Security Check: Only producers can update order statuses
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'producer') {
    header("Location: ../auth/login.php?error=unauthorized");
    exit();
}

// 2. Validate the POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id']) && isset($_POST['new_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['new_status'];

    // List of allowed statuses to prevent database corruption
    $allowed_statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];

    if (in_array($new_status, $allowed_statuses)) {
        try {
            // 3. Update the status in tbl_orders
            $stmt = $pdo->prepare("UPDATE tbl_orders SET status = ? WHERE order_id = ?");
            $stmt->execute([$new_status, $order_id]);

            // 4. Success: Redirect back to the orders list
            header("Location: orders.php?success=status_updated");
            exit();
        } catch (PDOException $e) {
            // Handle database errors gracefully
            die("Database Error: " . $e->getMessage());
        }
    } else {
        // Redirect if an invalid status was somehow submitted
        header("Location: orders.php?error=invalid_status");
        exit();
    }
} else {
    // Redirect if the page is accessed without a POST request
    header("Location: orders.php");
    exit();
}