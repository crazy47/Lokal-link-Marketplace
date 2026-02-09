<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

// 1. Security Check: Ensure user is logged in and is a producer
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'producer') {
    header("Location: ../auth/login.php?error=unauthorized");
    exit();
}

try {
    $user_id = $_SESSION['user_id'];

    // 2. Fetch Producer Profile Info
    $stmt = $pdo->prepare("SELECT * FROM tbl_producerprofiles WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $producer = $stmt->fetch();
    $producer_id = $producer['producer_id'];

    // 3. Fetch Statistics
    
    // Total Active Products
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM tbl_products WHERE producer_id = ? AND is_active = 1");
    $stmt->execute([$producer_id]);
    $active_products_count = $stmt->fetchColumn();

    // Pending Orders count (Orders containing this producer's products that are 'pending')
    $stmt = $pdo->prepare("
        SELECT COUNT(DISTINCT oi.order_id) 
        FROM tbl_orderitems oi
        JOIN tbl_products p ON oi.product_id = p.product_id
        JOIN tbl_orders o ON oi.order_id = o.order_id
        WHERE p.producer_id = ? AND o.status = 'pending'
    ");
    $stmt->execute([$producer_id]);
    $pending_orders_count = $stmt->fetchColumn();

    // Total Earnings (Sum of all items sold across delivered orders)
    $stmt = $pdo->prepare("
        SELECT SUM(oi.quantity * oi.price_at_purchase) 
        FROM tbl_orderitems oi
        JOIN tbl_products p ON oi.product_id = p.product_id
        JOIN tbl_orders o ON oi.order_id = o.order_id
        WHERE p.producer_id = ? AND o.status = 'delivered'
    ");
    $stmt->execute([$producer_id]);
    $total_earnings = $stmt->fetchColumn() ?: 0;

    // 4. Fetch Recent Inventory (Top 5 items)
    $stmt = $pdo->prepare("
        SELECT p.*, c.category_name 
        FROM tbl_products p
        JOIN tbl_categories c ON p.category_id = c.category_id
        WHERE p.producer_id = ? 
        ORDER BY p.product_name ASC 
        LIMIT 5
    ");
    $stmt->execute([$producer_id]);
    $recent_products = $stmt->fetchAll();

} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}

include '../includes/header.php'; 
?>

<main class="min-h-screen bg-[#EAEFEF] py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <header class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
            <div class="space-y-1">
                <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400">Producer Portal</h4>
                <h2 class="text-4xl font-black uppercase tracking-tighter text-gray-900">
                    <?php echo h($producer['business_name']); ?>
                </h2>
            </div>
            <div class="flex gap-4">
                <a href="../auth/logout.php" class="border-2 border-gray-900 px-6 py-4 text-[10px] font-black uppercase tracking-[0.3em] hover:bg-gray-900 hover:text-white transition-all">
                    Logout
                </a>
                <a href="manage-products.php" class="bg-[#1E4033] text-white px-8 py-4 text-[10px] font-black uppercase tracking-[0.3em] hover:brightness-110 transition-all">
                    + Add New Product
                </a>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white p-10 border-[3px] border-white shadow-[0_0_30px_rgba(0,0,0,0.03)]">
                <span class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Active Products</span>
                <span class="text-4xl font-black text-gray-900 tracking-tighter">
                    <?php echo str_pad($active_products_count, 2, '0', STR_PAD_LEFT); ?>
                </span>
            </div>
            
            <div class="bg-white p-10 border-[3px] border-white shadow-[0_0_30px_rgba(0,0,0,0.03)]">
                <span class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Pending Orders</span>
                <span class="text-4xl font-black text-[#1E4033] tracking-tighter">
                    <?php echo str_pad($pending_orders_count, 2, '0', STR_PAD_LEFT); ?>
                </span>
            </div>
            
            <div class="bg-white p-10 border-[3px] border-white shadow-[0_0_30px_rgba(0,0,0,0.03)]">
                <span class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Total Earnings</span>
                <span class="text-4xl font-black text-gray-900 tracking-tighter">
                    ₱<?php echo number_format($total_earnings, 2); ?>
                </span>
            </div>
        </div>

        <div class="bg-white border-[3px] border-white shadow-[0_0_30px_rgba(0,0,0,0.03)] overflow-hidden">
            <div class="p-8 border-b border-gray-50 flex justify-between items-center">
                <h3 class="text-sm font-black uppercase tracking-widest text-gray-900">Recent Inventory</h3>
                <a href="manage-products.php" class="text-[10px] font-bold uppercase tracking-widest text-[#1E4033] border-b-2 border-[#1E4033] pb-1">Manage All Inventory</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50 text-[10px] font-black uppercase tracking-widest text-gray-400">
                            <th class="px-8 py-5">Product Details</th>
                            <th class="px-8 py-5">Unit Price</th>
                            <th class="px-8 py-5">Stock</th>
                            <th class="px-8 py-5">MOQ</th>
                            <th class="px-8 py-5 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php if (empty($recent_products)): ?>
                            <tr>
                                <td colspan="5" class="px-8 py-12 text-center text-xs font-bold uppercase tracking-widest text-gray-400">
                                    No products listed yet.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($recent_products as $product): ?>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-8 py-6">
                                    <span class="block text-sm font-black uppercase tracking-tight text-gray-900"><?php echo h($product['product_name']); ?></span>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest"><?php echo h($product['category_name']); ?></span>
                                </td>
                                <td class="px-8 py-6 text-sm font-bold text-[#1E4033]">₱<?php echo number_format($product['unit_price'], 2); ?></td>
                                <td class="px-8 py-6 text-sm font-bold text-gray-600"><?php echo $product['stock_quantity']; ?> Units</td>
                                <td class="px-8 py-6 text-sm font-bold text-gray-600"><?php echo $product['moq']; ?> Units</td>
                                <td class="px-8 py-6 text-right">
                                    <span class="px-3 py-1 <?php echo $product['is_active'] ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700'; ?> text-[9px] font-black uppercase tracking-widest">
                                        <?php echo $product['is_active'] ? 'Active' : 'Inactive'; ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>