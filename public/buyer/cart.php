<?php 
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

// 1. Security Check
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'buyer') {
    header("Location: ../auth/login.php");
    exit();
}

$cart_items = [];
$total_amount = 0;

// 2. Fetch Cart Details from DB
if (!empty($_SESSION['cart'])) {
    $placeholders = implode(',', array_fill(0, count($_SESSION['cart']), '?'));
    $query = "
        SELECT p.*, pp.business_name 
        FROM tbl_products p
        JOIN tbl_producerprofiles pp ON p.producer_id = pp.producer_id
        WHERE p.product_id IN ($placeholders)
    ";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute(array_keys($_SESSION['cart']));
    $cart_items = $stmt->fetchAll();
}

include '../includes/header.php'; 
?>

<main class="min-h-screen bg-[#EAEFEF] py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <header class="mb-12">
            <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 mb-2">Order Review</h4>
            <h2 class="text-4xl font-black uppercase tracking-tighter text-gray-900">Your Procurement Cart</h2>
        </header>

        <?php if (empty($cart_items)): ?>
            <div class="bg-white border-[3px] border-white shadow-[0_0_40px_rgba(0,0,0,0.03)] p-20 text-center">
                <p class="text-xs font-black uppercase tracking-[0.4em] text-gray-400 mb-8">Your cart is currently empty.</p>
                <a href="marketplace.php" class="inline-block bg-[#1E4033] text-white px-10 py-5 text-[10px] font-black uppercase tracking-[0.3em]">Browse Inventory</a>
            </div>
        <?php else: ?>
            <div class="flex flex-col lg:flex-row gap-12">
                <div class="lg:w-2/3 space-y-4">
                    <?php foreach ($cart_items as $item): 
                        $quantity = $_SESSION['cart'][$item['product_id']];
                        $subtotal = $item['unit_price'] * $quantity;
                        $total_amount += $subtotal;
                    ?>
                    <div class="bg-white border-[3px] border-white shadow-[0_0_30px_rgba(0,0,0,0.03)] p-8 flex items-center justify-between">
                        <div class="flex items-center gap-6">
                            <div class="w-20 h-20 bg-gray-100 overflow-hidden">
                                <img src="../assets/uploads/backgroundhero.jpg" class="w-full h-full object-cover grayscale">
                            </div>
                            <div>
                                <h3 class="text-sm font-black uppercase tracking-widest text-gray-900 mb-1"><?php echo h($item['product_name']); ?></h3>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Producer: <?php echo h($item['business_name']); ?></p>
                            </div>
                        </div>
                        <div class="text-right space-y-2">
                            <span class="block text-sm font-black text-[#1E4033]">₱<?php echo number_format($subtotal, 2); ?></span>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Qty: <?php echo $quantity; ?> (Min: <?php echo $item['moq']; ?>)</span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="lg:w-1/3">
                    <div class="bg-[#1E4033] text-white p-10 shadow-[0_30px_60px_rgba(30,64,51,0.2)] space-y-10">
                        <h3 class="text-xl font-black uppercase tracking-widest border-b border-white/10 pb-4">Summary</h3>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between text-[10px] font-bold uppercase tracking-widest opacity-70">
                                <span>Subtotal</span>
                                <span>₱<?php echo number_format($total_amount, 2); ?></span>
                            </div>
                            <div class="flex justify-between text-[10px] font-bold uppercase tracking-widest opacity-70">
                                <span>Logistics (Direct)</span>
                                <span>TBD</span>
                            </div>
                            <div class="pt-4 border-t border-white/10 flex justify-between items-end">
                                <span class="text-[10px] font-black uppercase tracking-widest">Total Amount</span>
                                <span class="text-2xl font-black tracking-tighter">₱<?php echo number_format($total_amount, 2); ?></span>
                            </div>
                        </div>

                        <form action="checkout.php" method="POST"> 
                            <button type="submit" class="w-full bg-white text-[#1E4033] py-6 text-[10px] font-black uppercase tracking-[0.4em] hover:bg-gray-100 transition-all">
                                Complete Procurement
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include '../includes/footer.php'; ?>