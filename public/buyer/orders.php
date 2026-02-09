<?php 
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'buyer') {
    header("Location: ../auth/login.php");
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT buyer_id FROM tbl_buyerprofiles WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $buyer = $stmt->fetch();
    $buyer_id = $buyer['buyer_id'];

    $o_stmt = $pdo->prepare("SELECT * FROM tbl_orders WHERE buyer_id = ? ORDER BY order_date DESC");
    $o_stmt->execute([$buyer_id]);
    $orders = $o_stmt->fetchAll();
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}

include '../includes/header.php'; 
?>

<main class="min-h-screen bg-[#EAEFEF] py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <header class="mb-12">
            <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 mb-2">Procurement History</h4>
            <h2 class="text-4xl font-black uppercase tracking-tighter text-gray-900">Your Orders</h2>
        </header>

        <div class="bg-white border-[3px] border-white shadow-[0_0_40px_rgba(0,0,0,0.05)] overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 text-[10px] font-black uppercase tracking-widest text-gray-400">
                        <th class="px-8 py-5">Order ID</th>
                        <th class="px-8 py-5">Details</th>
                        <th class="px-8 py-5">Status</th>
                        <th class="px-8 py-5 text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php if (empty($orders)): ?>
                        <tr><td colspan="4" class="px-8 py-20 text-center text-xs font-bold uppercase text-gray-400">No orders yet.</td></tr>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-6 text-xs font-bold font-mono text-gray-400">#<?php echo substr($order['order_id'], 0, 8); ?></td>
                            <td class="px-8 py-6">
                                <span class="block text-sm font-bold text-gray-900 uppercase tracking-widest"><?php echo date('M d, Y', strtotime($order['order_date'])); ?></span>
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Via: <?php echo h($order['payment_method']); ?></span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 text-[9px] font-black uppercase tracking-widest"><?php echo h($order['status']); ?></span>
                            </td>
                            <td class="px-8 py-6 text-right text-sm font-black text-[#1E4033]">₱<?php echo number_format($order['total_amount'], 2); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>