<?php
session_start();
require_once '../includes/db.php';

if (isset($_GET['id']) && $_SESSION['user_type'] === 'producer') {
    try {
        $stmt = $pdo->prepare("DELETE FROM tbl_products WHERE product_id = ?");
        $stmt->execute([$_GET['id']]);
        header("Location: manage-products.php?success=deleted");
    } catch (PDOException $e) {
        // Blocks deletion if the product is already in an order
        die("Cannot delete: This product is part of an existing order record.");
    }
} else {
    header("Location: manage-products.php");
}
exit();