<?php 
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (!isset($_SESSION['user_id']) || empty($_SESSION['cart'])) {
    header("Location: marketplace.php");
    exit();
}

// 1. Final Price Calculation
$total_amount = 0;
$placeholders = implode(',', array_fill(0, count($_SESSION['cart']), '?'));
$stmt = $pdo->prepare("SELECT product_id, unit_price FROM tbl_products WHERE product_id IN ($placeholders)");
$stmt->execute(array_keys($_SESSION['cart']));
$products = $stmt->fetchAll();

foreach ($products as $p) {
    $total_amount += ($p['unit_price'] * $_SESSION['cart'][$p['product_id']]);
}

include '../includes/header.php'; 
?>

<main class="min-h-screen bg-[#EAEFEF] py-12">
    <div class="max-w-4xl mx-auto px-4">
        <header class="mb-12 text-center">
            <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 mb-2">Final Step</h4>
            <h2 class="text-4xl font-black uppercase tracking-tighter text-gray-900">Procurement Review</h2>
        </header>

        <form action="process_checkout.php" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white border-[3px] border-white shadow-[0_0_40px_rgba(0,0,0,0.05)] p-10">
                    <h3 class="text-sm font-black uppercase tracking-widest text-gray-900 mb-8 border-b pb-4">Select Payment Method</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <p class="text-[9px] font-black uppercase text-gray-400 tracking-[0.2em] mb-3">Cash Standard</p>
                            <label class="flex items-center p-5 border-2 border-gray-100 cursor-pointer hover:border-[#1E4033] has-[:checked]:border-[#1E4033] has-[:checked]:bg-gray-50 transition-all">
                                <input type="radio" name="payment_method" value="Cash on Delivery" checked class="mr-4 accent-[#1E4033]">
                                <span class="text-[11px] font-black uppercase tracking-widest">Cash on Delivery</span>
                            </label>
                        </div>

                        <div>
                            <p class="text-[9px] font-black uppercase text-gray-400 tracking-[0.2em] mb-3">E-Wallets (Digital)</p>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <?php foreach(['GCash', 'PayMaya', 'PayPal'] as $wallet): ?>
                                <label class="flex items-center p-4 border-2 border-gray-100 cursor-pointer hover:border-[#1E4033] has-[:checked]:border-[#1E4033] has-[:checked]:bg-gray-50 transition-all">
                                    <input type="radio" name="payment_method" value="<?php echo $wallet; ?>" class="mr-3 accent-[#1E4033]">
                                    <span class="text-[10px] font-bold uppercase"><?php echo $wallet; ?></span>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div>
                            <p class="text-[9px] font-black uppercase text-gray-400 tracking-[0.2em] mb-3">Online Banking</p>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <?php foreach(['BPI', 'ChinaBank', 'MasterCard'] as $bank): ?>
                                <label class="flex items-center p-4 border-2 border-gray-100 cursor-pointer hover:border-[#1E4033] has-[:checked]:border-[#1E4033] has-[:checked]:bg-gray-50 transition-all">
                                    <input type="radio" name="payment_method" value="<?php echo $bank; ?>" class="mr-3 accent-[#1E4033]">
                                    <span class="text-[10px] font-bold uppercase"><?php echo $bank; ?></span>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-[#1E4033] text-white p-10 shadow-2xl sticky top-32">
                    <h3 class="text-lg font-black uppercase tracking-widest mb-8 border-b border-white/10 pb-4">Bill Summary</h3>
                    <div class="space-y-6">
                        <div class="flex justify-between items-end">
                            <span class="text-[10px] font-bold uppercase opacity-60 tracking-widest">Total Cost</span>
                            <span class="text-3xl font-black tracking-tighter">₱<?php echo number_format($total_amount, 2); ?></span>
                        </div>
                        <button type="submit" class="w-full bg-white text-[#1E4033] py-6 text-[11px] font-black uppercase tracking-[0.4em] hover:bg-gray-100 transition-all">
                            Confirm Order
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</main>

<?php include '../includes/footer.php'; ?>