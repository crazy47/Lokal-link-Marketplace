<?php
// 1. Connection and Utilities
require_once '../includes/db.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 2. Capture and Hash Data
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $user_type = $_POST['user_type']; // 'buyer' or 'producer'
    
    // Generate UUID for the User
    $user_id = generate_uuid(); 

    try {
        // 3. Start Transaction: Both inserts must succeed or both fail
        $pdo->beginTransaction();

        // 4. Insert into tbl_users
        $stmt = $pdo->prepare("INSERT INTO tbl_users (user_id, email, password_hash, user_type) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $email, $password, $user_type]);

        // 5. Insert into specific Profile Table based on selection
        if ($user_type === 'producer') {
            $producer_id = generate_uuid(); // PK for Producer table
            $stmt = $pdo->prepare("INSERT INTO tbl_producerprofiles (producer_id, user_id, business_name, farm_size, certification_type, verified_status) VALUES (?, ?, ?, ?, ?, 'pending')");
            $stmt->execute([
                $producer_id, 
                $user_id, 
                $_POST['business_name'], 
                $_POST['farm_size'], 
                $_POST['certification_type']
            ]);
        } else {
            $buyer_id = generate_uuid(); // PK for Buyer table
            $stmt = $pdo->prepare("INSERT INTO tbl_buyerprofiles (buyer_id, user_id, company_name, business_reg_number) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $buyer_id, 
                $user_id, 
                $_POST['company_name'], 
                $_POST['business_reg_number']
            ]);
        }

        // 6. Commit the changes
        $pdo->commit();
        
        // Redirect to login with success message
        header("Location: login.php?registration=success");
        exit();

    } catch (Exception $e) {
        // Rollback if anything goes wrong to prevent "orphaned" users
        $pdo->rollBack();
        die("Registration Error: " . $e->getMessage());
    }
}