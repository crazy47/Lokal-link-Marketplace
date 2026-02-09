<?php
// Start session if not already active to check user role and cart
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Calculate cart count for the badge if user is a buyer
$cart_count = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    $cart_count = array_sum($_SESSION['cart']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokal-Link | B2B Marketplace</title>
    <link href="/Lokal-link/public/assets/css/style.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-producer-green { background-color: #1E4033; }
        .text-producer-green { color: #1E4033; }
        .border-producer-green { border-color: #1E4033; }
        /* Professional Font Standard */
        body { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-800 font-sans">
    <div class="bg-producer-green text-white py-2 px-4 text-center">
        <p class="text-[10px] md:text-xs font-bold uppercase tracking-[0.3em]">
            ✓ Verified Local Producers Only • Direct B2B Wholesale Pricing
        </p>
    </div>
    
    <nav class="border-b border-gray-200 bg-white sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-24 items-center">
                
                <div class="flex items-center space-x-4">
                    <a href="/Lokal-link/public/index.php" class="flex items-center space-x-3">
                        <img src="/Lokal-link/public/assets/uploads/lokal-link-logo.png" alt="Lokal-Link" class="h-14 w-auto">
                        <div class="flex flex-col">
                            <span class="text-2xl font-bold tracking-tighter text-producer-green leading-none uppercase">Lokal-Link</span>
                            <span class="text-[10px] tracking-[0.2em] text-gray-500 uppercase font-medium">B2B Marketplace</span>
                        </div>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-10">
                    
                    <?php if (isset($_SESSION['user_id'])): ?>
                        
                        <?php if ($_SESSION['user_type'] === 'buyer'): ?>
                            <a href="/Lokal-link/public/buyer/marketplace.php" class="text-sm font-semibold uppercase tracking-wider text-gray-600 hover:text-producer-green transition-colors">Marketplace</a>
                            <a href="/Lokal-link/public/buyer/orders.php" class="text-sm font-semibold uppercase tracking-wider text-gray-600 hover:text-producer-green transition-colors">My Orders</a>
                            <a href="/Lokal-link/public/buyer/cart.php" class="relative group text-sm font-bold uppercase tracking-wider text-producer-green">
                                Cart
                                <?php if ($cart_count > 0): ?>
                                    <span class="absolute -top-3 -right-4 bg-producer-green text-white text-[9px] font-black w-5 h-5 flex items-center justify-center rounded-full border-2 border-white">
                                        <?php echo $cart_count; ?>
                                    </span>
                                <?php endif; ?>
                            </a>

                        <?php else: ?>
                            <a href="/Lokal-link/public/producer/dashboard.php" class="text-sm font-semibold uppercase tracking-wider text-gray-600 hover:text-producer-green transition-colors">Dashboard</a>
                            <a href="/Lokal-link/public/producer/manage-products.php" class="text-sm font-semibold uppercase tracking-wider text-gray-600 hover:text-producer-green transition-colors">Inventory</a>
                            <a href="/Lokal-link/public/producer/orders.php" class="text-sm font-bold uppercase tracking-wider text-producer-green">Incoming Orders</a>
                        <?php endif; ?>

                        <div class="h-6 w-px bg-gray-200"></div>
                        
                        <a href="/Lokal-link/public/profile.php" class="text-sm font-semibold uppercase tracking-wider text-gray-600 hover:text-producer-green transition-colors">Profile</a>
                        <a href="/Lokal-link/public/auth/logout.php" class="text-sm font-bold uppercase tracking-wider text-red-600 hover:text-red-800 transition-colors">Sign Out</a>

                    <?php else: ?>
                        <a href="/Lokal-link/public/buyer/marketplace.php" class="text-sm font-semibold uppercase tracking-wider text-gray-600 hover:text-producer-green transition-colors">Marketplace</a>
                        <div class="h-6 w-px bg-gray-200"></div>
                        <a href="/Lokal-link/public/auth/login.php" class="text-sm font-semibold uppercase tracking-wider text-gray-600 hover:text-producer-green">Sign In</a>
                        <a href="/Lokal-link/public/auth/register.php" class="bg-producer-green text-white px-8 py-3 text-sm font-bold uppercase tracking-widest hover:brightness-110 transition-all">
                            Get Started
                        </a>
                    <?php endif; ?>
                </div>

                <div class="md:hidden">
                    <button onclick="document.getElementById('mobile-nav').classList.toggle('hidden')" class="p-2 text-producer-green">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-nav" class="hidden md:hidden border-t border-gray-100 p-4 space-y-4 bg-gray-50">
            <?php if (isset($_SESSION['user_id'])): ?>
                <?php if ($_SESSION['user_type'] === 'buyer'): ?>
                    <a href="/Lokal-link/public/buyer/marketplace.php" class="block text-sm font-bold uppercase text-gray-700">Marketplace</a>
                    <a href="/Lokal-link/public/buyer/orders.php" class="block text-sm font-bold uppercase text-gray-700">My Orders</a>
                    <a href="/Lokal-link/public/buyer/cart.php" class="block text-sm font-bold uppercase text-producer-green">Cart (<?php echo $cart_count; ?>)</a>
                <?php else: ?>
                    <a href="/Lokal-link/public/producer/dashboard.php" class="block text-sm font-bold uppercase text-gray-700">Dashboard</a>
                    <a href="/Lokal-link/public/producer/manage-products.php" class="block text-sm font-bold uppercase text-gray-700">Inventory</a>
                    <a href="/Lokal-link/public/producer/orders.php" class="block text-sm font-bold uppercase text-producer-green">Incoming Orders</a>
                <?php endif; ?>
                
                <div class="border-t border-gray-100 pt-4">
                    <a href="/Lokal-link/public/profile.php" class="block text-sm font-bold uppercase text-gray-700">My Profile</a>
                    <a href="/Lokal-link/public/auth/logout.php" class="block text-sm font-bold uppercase text-red-600 mt-2">Sign Out</a>
                </div>
            <?php else: ?>
                <a href="/Lokal-link/public/buyer/marketplace.php" class="block text-sm font-bold uppercase text-gray-700">Marketplace</a>
                <a href="/Lokal-link/public/auth/login.php" class="block text-sm font-bold uppercase text-gray-700">Sign In</a>
                <a href="/Lokal-link/public/auth/register.php" class="block bg-producer-green text-white p-4 text-center text-sm font-bold uppercase">Get Started</a>
            <?php endif; ?>
        </div>
    </nav>  