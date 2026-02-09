<?php 
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

// 1. Security Check
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'producer') {
    header("Location: ../auth/login.php");
    exit();
}

// 2. Get Product ID from URL
$product_id = $_GET['id'] ?? null;

if (!$product_id) {
    header("Location: manage-products.php");
    exit();
}

// 3. Handle Form Submission (Update Logic)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("
            UPDATE tbl_products 
            SET product_name = ?, unit_price = ?, stock_quantity = ?, moq = ? 
            WHERE product_id = ?
        ");
        $stmt->execute([
            $_POST['product_name'], 
            $_POST['unit_price'], 
            $_POST['stock_quantity'], 
            $_POST['moq'], 
            $product_id
        ]);
        
        header("Location: manage-products.php?success=updated");
        exit();
    } catch (PDOException $e) {
        die("Update Error: " . $e->getMessage());
    }
}

// 4. Fetch Current Data to fill the form
$stmt = $pdo->prepare("SELECT * FROM tbl_products WHERE product_id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) {
    die("Product not found.");
}

include '../includes/header.php'; 
?>

<main class="min-h-screen bg-[#EAEFEF] py-12">
    <div class="max-w-xl mx-auto px-4">
        <div class="bg-white border-[3px] border-white shadow-[0_0_40px_rgba(0,0,0,0.05)] p-12">
            <h2 class="text-2xl font-black uppercase tracking-tighter text-gray-900 mb-8">Edit Product</h2>
            
            <form method="POST" class="space-y-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Product Name</label>
                    <input type="text" name="product_name" value="<?php echo h($product['product_name']); ?>" required 
                        class="w-full border-b-2 border-gray-100 py-2 font-bold uppercase tracking-widest focus:outline-none focus:border-[#1E4033] text-sm">
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Price (₱)</label>
                        <input type="number" step="0.01" name="unit_price" value="<?php echo $product['unit_price']; ?>" required 
                            class="w-full border-b-2 border-gray-100 py-2 font-bold focus:outline-none focus:border-[#1E4033]">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Stock</label>
                        <input type="number" name="stock_quantity" value="<?php echo $product['stock_quantity']; ?>" required 
                            class="w-full border-b-2 border-gray-100 py-2 font-bold focus:outline-none focus:border-[#1E4033]">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Minimum Order (MOQ)</label>
                    <input type="number" name="moq" value="<?php echo $product['moq']; ?>" required 
                        class="w-full border-b-2 border-gray-100 py-2 font-bold focus:outline-none focus:border-[#1E4033]">
                </div>

                <div class="flex gap-4 pt-4">
                    <a href="manage-products.php" class="flex-1 text-center border-2 border-gray-900 py-5 text-[10px] font-black uppercase tracking-[0.3em]">Cancel</a>
                    <button type="submit" class="flex-1 bg-[#1E4033] text-white py-5 text-[10px] font-black uppercase tracking-[0.3em] hover:brightness-110">Update</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>