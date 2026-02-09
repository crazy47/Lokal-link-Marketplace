<?php 
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'producer') {
    header("Location: ../auth/login.php?error=unauthorized");
    exit();
}

try {
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT producer_id FROM tbl_producerprofiles WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $producer = $stmt->fetch();
    $producer_id = $producer['producer_id'];

    $query = "
        SELECT 
            o.order_id, 
            o.order_date, 
            o.status, 
            o.payment_method,
            bp.company_name,
            SUM(oi.quantity * oi.price_at_purchase) as producer_subtotal
        FROM tbl_orders o
        JOIN tbl_buyerprofiles bp ON o.buyer_id = bp.buyer_id
        JOIN tbl_orderitems oi ON o.order_id = oi.order_id
        JOIN tbl_products p ON oi.product_id = p.product_id
        WHERE p.producer_id = ?
        GROUP BY o.order_id
        ORDER BY o.order_date DESC
    ";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute([$producer_id]);
    $orders = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}

include '../includes/header.php'; 
?>

<main class="min-h-screen bg-[#EAEFEF] py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <header class="mb-12">
            <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 mb-2">Order Fulfillment</h4>
            <h2 class="text-4xl font-black uppercase tracking-tighter text-gray-900">Incoming B2B Orders</h2>
        </header>

        <div class="bg-white border-[3px] border-white shadow-[0_0_40px_rgba(0,0,0,0.05)] overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 text-[10px] font-black uppercase tracking-widest text-gray-400">
                        <th class="px-8 py-5">Order Reference</th>
                        <th class="px-8 py-5">Buyer & Payment</th>
                        <th class="px-8 py-5">Earning</th>
                        <th class="px-8 py-5">Current Status</th>
                        <th class="px-8 py-5 text-right">Update Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php if (empty($orders)): ?>
                        <tr><td colspan="5" class="px-8 py-20 text-center text-xs font-bold uppercase tracking-widest text-gray-400">No incoming orders yet.</td></tr>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-6 text-xs font-bold font-mono text-gray-400">#<?php echo substr($order['order_id'], 0, 8); ?></td>
                            <td class="px-8 py-6">
                                <span class="block text-sm font-black uppercase text-gray-900"><?php echo h($order['company_name']); ?></span>
                                <span class="text-[9px] font-black text-[#1E4033] uppercase tracking-widest"><?php echo h($order['payment_method']); ?></span>
                            </td>
                            <td class="px-8 py-6 text-sm font-black text-[#1E4033]">₱<?php echo number_format($order['producer_subtotal'], 2); ?></td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 text-[9px] font-black uppercase tracking-widest rounded"><?php echo h($order['status']); ?></span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <form action="update_order_status.php" method="POST" class="flex justify-end gap-2">
                                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                    <select name="new_status" class="bg-gray-50 border border-gray-100 text-[10px] font-black uppercase tracking-widest px-2 py-2 focus:outline-none focus:border-[#1E4033]">
                                        <option value="pending" <?php echo $order['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                        <option value="processing" <?php echo $order['status'] == 'processing' ? 'selected' : ''; ?>>Processing</option>
                                        <option value="shipped" <?php echo $order['status'] == 'shipped' ? 'selected' : ''; ?>>Shipped</option>
                                        <option value="delivered" <?php echo $order['status'] == 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                                    </select>
                                    <button type="submit" class="bg-[#1E4033] text-white px-4 py-2 text-[10px] font-black uppercase tracking-widest hover:brightness-110">Save</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>