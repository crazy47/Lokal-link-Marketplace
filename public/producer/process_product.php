<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Security: Only producers can add products
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'producer') {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Get the producer_id for the logged-in user
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT producer_id FROM tbl_producerprofiles WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $producer = $stmt->fetch();

    if (!$producer) {
        die("Producer profile not found.");
    }

    // 2. Capture Form Data
    $product_id = generate_uuid(); // PK for tbl_products
    $producer_id = $producer['producer_id']; // FK from tbl_producerprofiles
    $category_id = $_POST['category_id']; // FK from tbl_categories
    $product_name = $_POST['product_name'];
    $unit_price = $_POST['unit_price'];
    $stock_quantity = $_POST['stock_quantity'];
    $moq = $_POST['moq'];
    $is_active = 1; // Default to active

    try {
        // 3. Insert into tbl_products
        $sql = "INSERT INTO tbl_products (product_id, producer_id, category_id, product_name, unit_price, stock_quantity, moq, is_active) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $product_id, 
            $producer_id, 
            $category_id, 
            $product_name, 
            $unit_price, 
            $stock_quantity, 
            $moq, 
            $is_active
        ]);

        header("Location: manage-products.php?success=product_added");
        exit();

    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}