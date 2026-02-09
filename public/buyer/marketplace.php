<?php 
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

// 1. Security Check: Only buyers can access the marketplace
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'buyer') {
    header("Location: ../auth/login.php?error=unauthorized");
    exit();
}

try {
    // 2. Fetch Categories for the Filter Bar
    $cat_stmt = $pdo->query("SELECT * FROM tbl_categories ORDER BY category_name ASC");
    $categories = $cat_stmt->fetchAll();

    // 3. Fetch Active Products with Producer & Category Details
    // We join tbl_products with producer profiles and categories to get the full picture
    $query = "
        SELECT p.*, pp.business_name, pp.verified_status, c.category_name 
        FROM tbl_products p
        JOIN tbl_producerprofiles pp ON p.producer_id = pp.producer_id
        JOIN tbl_categories c ON p.category_id = c.category_id
        WHERE p.is_active = 1
        ORDER BY p.product_name ASC
    ";
    $p_stmt = $pdo->query($query);
    $products = $p_stmt->fetchAll();
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}

include '../includes/header.php'; 
?>

<main class="min-h-screen bg-[#EAEFEF] py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <header class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div class="space-y-2">
                <h4 class="text-xs font-black uppercase tracking-[0.4em] text-[#1E4033]">B2B Inventory</h4>
                <h2 class="text-4xl font-black uppercase tracking-tighter text-gray-900">Current Marketplace</h2>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <select class="bg-white border-2 border-white px-6 py-4 text-[10px] font-black uppercase tracking-widest focus:outline-none focus:border-[#1E4033] shadow-sm">
                    <option>All Categories</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo h($cat['category_id']); ?>"><?php echo h($cat['category_name']); ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="text" placeholder="Search Products..." 
                    class="bg-white border-2 border-white px-6 py-4 text-[10px] font-black uppercase tracking-widest focus:outline-none focus:border-[#1E4033] shadow-sm w-full sm:w-64">
            </div>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <?php if (empty($products)): ?>
                <div class="col-span-full bg-white p-20 text-center border-[3px] border-white shadow-[0_0_40px_rgba(0,0,0,0.03)]">
                    <p class="text-xs font-black uppercase tracking-[0.4em] text-gray-400">No active listings available at the moment.</p>
                </div>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                <div class="bg-white border-[3px] border-white shadow-[0_0_30px_rgba(0,0,0,0.03)] group transition-all">
                    <div class="aspect-square relative overflow-hidden bg-gray-100">
                        <img src="../assets/uploads/backgroundhero.jpg" alt="Product" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105">
                        
                        <?php if ($product['verified_status'] === 'verified'): ?>
                        <div class="absolute top-0 left-0 bg-[#1E4033] text-white px-4 py-2 text-[9px] font-black uppercase tracking-widest z-10">
                            Verified Source
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="p-8 space-y-6">
                        <div>
                            <h3 class="text-sm font-black uppercase tracking-widest text-gray-900 mb-1 leading-tight">
                                <?php echo h($product['product_name']); ?>
                            </h3>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                <?php echo h($product['business_name']); ?> • <?php echo h($product['category_name']); ?>
                            </p>
                        </div>

                        <div class="pt-6 border-t border-gray-50 flex justify-between items-end">
                            <div class="space-y-1">
                                <span class="block text-[9px] font-black text-gray-400 uppercase tracking-tighter">Unit Price</span>
                                <span class="text-xl font-black text-[#1E4033]">₱<?php echo number_format($product['unit_price'], 2); ?></span>
                            </div>
                            <div class="text-right space-y-1">
                                <span class="block text-[9px] font-black text-gray-400 uppercase tracking-tighter">MOQ</span>
                                <span class="text-xs font-bold text-gray-900 uppercase"><?php echo $product['moq']; ?> Units</span>
                            </div>
                        </div>

                        <form action="add_to_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo h($product['product_id']); ?>">
                            <button type="submit" class="w-full bg-[#1E4033] text-white py-5 text-[10px] font-black uppercase tracking-[0.3em] hover:brightness-110 transition-all">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>