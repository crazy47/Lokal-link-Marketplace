<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SESSION['cart'])) {
    header("Location: marketplace.php");
    exit();
}

$payment_method = $_POST['payment_method'] ?? 'Cash on Delivery';

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("SELECT buyer_id FROM tbl_buyerprofiles WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $buyer = $stmt->fetch();
    $buyer_id = $buyer['buyer_id'];

    $order_id = generate_uuid();
    $total_amount = 0;

    $placeholders = implode(',', array_fill(0, count($_SESSION['cart']), '?'));
    $stmt = $pdo->prepare("SELECT product_id, unit_price, stock_quantity FROM tbl_products WHERE product_id IN ($placeholders)");
    $stmt->execute(array_keys($_SESSION['cart']));
    $products = $stmt->fetchAll();

    foreach ($products as $p) {
        $total_amount += ($p['unit_price'] * $_SESSION['cart'][$p['product_id']]);
    }

    // Insert main order record
    $stmt = $pdo->prepare("INSERT INTO tbl_orders (order_id, buyer_id, status, total_amount, payment_method) VALUES (?, ?, 'pending', ?, ?)");
    $stmt->execute([$order_id, $buyer_id, $total_amount, $payment_method]);

    // Insert items AND Deduct Stock
    $stmt_items = $pdo->prepare("INSERT INTO tbl_orderitems (order_item_id, order_id, product_id, quantity, price_at_purchase) VALUES (?, ?, ?, ?, ?)");
    $stmt_stock = $pdo->prepare("UPDATE tbl_products SET stock_quantity = stock_quantity - ? WHERE product_id = ?");
    
    foreach ($products as $p) {
        $qty = $_SESSION['cart'][$p['product_id']];
        
        // 1. Record the item
        $stmt_items->execute([generate_uuid(), $order_id, $p['product_id'], $qty, $p['unit_price']]);
        
        // 2. Subtract from inventory
        $stmt_stock->execute([$qty, $p['product_id']]);
    }

    $pdo->commit();
    unset($_SESSION['cart']);
    header("Location: orders.php?success=order_placed");
    exit();

} catch (Exception $e) {
    if ($pdo->inTransaction()) { $pdo->rollBack(); }
    die("Checkout Error: " . $e->getMessage());
}