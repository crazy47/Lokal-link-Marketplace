<?php 
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

// 1. Security Check: Only producers can access this page
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'producer') {
    header("Location: ../auth/login.php?error=unauthorized");
    exit();
}

// 2. Fetch all categories for the dropdown
try {
    $cat_stmt = $pdo->query("SELECT * FROM tbl_categories ORDER BY category_name ASC");
    $categories = $cat_stmt->fetchAll();

    // 3. Fetch products specifically for this logged-in producer
    $p_stmt = $pdo->prepare("
        SELECT p.*, c.category_name 
        FROM tbl_products p 
        JOIN tbl_categories c ON p.category_id = c.category_id 
        WHERE p.producer_id = (SELECT producer_id FROM tbl_producerprofiles WHERE user_id = ?)
        ORDER BY p.product_name ASC
    ");
    $p_stmt->execute([$_SESSION['user_id']]);
    $products = $p_stmt->fetchAll();
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}

include '../includes/header.php'; 
?>

<main class="min-h-screen bg-[#EAEFEF] py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col lg:flex-row gap-12">
            <div class="lg:w-1/3">
                <div class="bg-white border-[3px] border-white shadow-[0_0_40px_rgba(0,0,0,0.05)] p-10">
                    <h3 class="text-2xl font-black uppercase tracking-tighter text-gray-900 mb-8">Add Product</h3>
                    
                    <form action="process_product.php" method="POST" class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Product Name</label>
                            <input type="text" name="product_name" required 
                                class="w-full border-b-2 border-gray-100 py-2 font-bold uppercase tracking-widest focus:outline-none focus:border-[#1E4033] text-sm">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Unit Price (₱)</label>
                                <input type="number" step="0.01" name="unit_price" required 
                                    class="w-full border-b-2 border-gray-100 py-2 font-bold uppercase tracking-widest focus:outline-none focus:border-[#1E4033] text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">MOQ</label>
                                <input type="number" name="moq" required 
                                    class="w-full border-b-2 border-gray-100 py-2 font-bold uppercase tracking-widest focus:outline-none focus:border-[#1E4033] text-sm">
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Initial Stock Quantity</label>
                                <input type="number" name="stock_quantity" required 
                                    class="w-full border-b-2 border-gray-100 py-2 font-bold uppercase tracking-widest focus:outline-none focus:border-[#1E4033] text-sm">
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Category</label>
                                <select name="category_id" required 
                                    class="w-full border-b-2 border-gray-100 py-2 font-bold uppercase tracking-widest focus:outline-none focus:border-[#1E4033] text-sm bg-transparent">
                                    <option value="">SELECT CATEGORY</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo h($category['category_id']); ?>">
                                            <?php echo h($category['category_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-[#1E4033] text-white py-5 text-[10px] font-black uppercase tracking-[0.3em] hover:brightness-110 transition-all mt-4">
                            Save Product
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:w-2/3">
                <div class="bg-white border-[3px] border-white shadow-[0_0_40px_rgba(0,0,0,0.05)] overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr class="text-[10px] font-black uppercase tracking-widest text-gray-400">
                                <th class="px-8 py-5">Product Details</th>
                                <th class="px-8 py-5">Price/MOQ</th>
                                <th class="px-8 py-5">Status</th>
                                <th class="px-8 py-5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php if (empty($products)): ?>
                                <tr>
                                    <td colspan="4" class="px-8 py-12 text-center text-xs font-bold uppercase tracking-widest text-gray-400">
                                        No products found in your inventory.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($products as $product): ?>
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-8 py-6">
                                        <span class="block text-sm font-black uppercase tracking-tight text-gray-900"><?php echo h($product['product_name']); ?></span>
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest"><?php echo h($product['category_name']); ?></span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="block text-sm font-bold text-[#1E4033]">₱<?php echo number_format($product['unit_price'], 2); ?></span>
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Min: <?php echo $product['moq']; ?> Units</span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="px-3 py-1 <?php echo $product['is_active'] ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700'; ?> text-[9px] font-black uppercase tracking-widest">
                                            <?php echo $product['is_active'] ? 'Active' : 'Inactive'; ?>
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-right space-x-4">
                                        <a href="edit-product.php?id=<?php echo $product['product_id']; ?>" class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-[#1E4033]">Edit</a>
                                        <a href="delete-product.php?id=<?php echo $product['product_id']; ?>" onclick="return confirm('Delete this product?')" class="text-[10px] font-black uppercase tracking-widest text-red-400 hover:text-red-600">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>