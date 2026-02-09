<?php 
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Security Check
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'producer') {
    header("Location: ../auth/login.php");
    exit();
}

$product_id = $_GET['id'] ?? null;

if (!$product_id) {
    header("Location: manage-products.php");
    exit();
}

// Handle the Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("UPDATE tbl_products SET product_name = ?, unit_price = ?, stock_quantity = ?, moq = ? WHERE product_id = ?");
        $stmt->execute([$_POST['product_name'], $_POST['unit_price'], $_POST['stock_quantity'], $_POST['moq'], $product_id]);
        header("Location: manage-products.php?success=updated");
        exit();
    } catch (PDOException $e) {
        die("Update Error: " . $e->getMessage());
    }
}

// Fetch the existing data
$stmt = $pdo->prepare("SELECT * FROM tbl_products WHERE product_id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) { die("Product not found."); }

include '../includes/header.php'; 
?>

<main class="min-h-screen bg-[#EAEFEF] py-12">
    <div class="max-w-xl mx-auto px-4 bg-white p-12 shadow-xl border-[3px] border-white">
        <h2 class="text-2xl font-black uppercase tracking-tighter mb-8">Edit Product Details</h2>
        <form method="POST" class="space-y-6">
            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase text-gray-400">Product Name</label>
                <input type="text" name="product_name" value="<?php echo h($product['product_name']); ?>" required class="w-full border-b-2 py-2 font-bold uppercase focus:border-[#1E4033] outline-none">
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="text-[10px] font-black uppercase text-gray-400">Price (₱)</label>
                    <input type="number" step="0.01" name="unit_price" value="<?php echo $product['unit_price']; ?>" required class="w-full border-b-2 py-2 font-bold outline-none">
                </div>
                <div>
                    <label class="text-[10px] font-black uppercase text-gray-400">Stock</label>
                    <input type="number" name="stock_quantity" value="<?php echo $product['stock_quantity']; ?>" required class="w-full border-b-2 py-2 font-bold outline-none">
                </div>
            </div>
            <div>
                <label class="text-[10px] font-black uppercase text-gray-400">MOQ</label>
                <input type="number" name="moq" value="<?php echo $product['moq']; ?>" required class="w-full border-b-2 py-2 font-bold outline-none">
            </div>
            <button type="submit" class="w-full bg-[#1E4033] text-white py-5 font-black uppercase tracking-widest hover:brightness-110">Save Changes</button>
        </form>
    </div>
</main>
<?php include '../includes/footer.php'; ?>