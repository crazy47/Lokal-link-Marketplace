<?php
// Include the DB connection we set up
require_once '../includes/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // 1. Fetch user by email from tbl_users
        $stmt = $pdo->prepare("SELECT * FROM tbl_users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // 2. Verify password against the hash
        if ($user && password_verify($password, $user['password_hash'])) {
            
            // 3. Set Session Variables for persistent access
            $_SESSION['user_id']   = $user['user_id'];
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['email']     = $user['email'];

            // 4. Role-Based Redirection
            if ($user['user_type'] === 'producer') {
                header("Location: ../producer/dashboard.php");
            } else if ($user['user_type'] === 'buyer') {
                header("Location: ../buyer/marketplace.php");
            } else {
                header("Location: ../index.php");
            }
            exit();

        } else {
            // Failure: Back to login with error
            header("Location: login.php?error=invalid_credentials");
            exit();
        }
    } catch (PDOException $e) {
        die("Login Error: " . $e->getMessage());
    }
}