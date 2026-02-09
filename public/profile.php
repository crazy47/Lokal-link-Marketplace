<?php 
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';

// 1. Security Check
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];

// 2. Handle Update Logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->beginTransaction();

        // Update basic user info
        $stmt = $pdo->prepare("UPDATE tbl_users SET email = ? WHERE user_id = ?");
        $stmt->execute([$_POST['email'], $user_id]);

        if ($user_type === 'buyer') {
            // Update Buyer Specifics
            $stmt = $pdo->prepare("UPDATE tbl_buyerprofiles SET company_name = ?, business_reg_number = ? WHERE user_id = ?");
            $stmt->execute([$_POST['company_name'], $_POST['reg_number'], $user_id]);
        } else {
            // Update Producer Specifics
            $stmt = $pdo->prepare("UPDATE tbl_producerprofiles SET business_name = ?, farm_size = ?, certification_type = ? WHERE user_id = ?");
            $stmt->execute([$_POST['business_name'], $_POST['farm_size'], $_POST['cert_type'], $user_id]);
        }

        $pdo->commit();
        $success = "Profile updated successfully!";
    } catch (PDOException $e) {
        $pdo->rollBack();
        $error = "Update failed: " . $e->getMessage();
    }
}

// 3. Fetch Current Data for Display
$stmt = $pdo->prepare("
    SELECT u.email, 
           b.company_name, b.business_reg_number,
           p.business_name, p.farm_size, p.certification_type
    FROM tbl_users u
    LEFT JOIN tbl_buyerprofiles b ON u.user_id = b.user_id
    LEFT JOIN tbl_producerprofiles p ON u.user_id = p.user_id
    WHERE u.user_id = ?
");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

include 'includes/header.php'; 
?>

<main class="min-h-screen bg-[#EAEFEF] py-20">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white border-[3px] border-white shadow-[0_0_50px_rgba(0,0,0,0.05)] p-12">
            
            <header class="mb-10">
                <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 mb-2">Account Management</h4>
                <h2 class="text-4xl font-black uppercase tracking-tighter text-gray-900">Your Profile</h2>
                <p class="text-[10px] font-bold uppercase text-producer-green mt-1">Logged in as <?php echo $user_type; ?></p>
            </header>

            <?php if (isset($success)): ?>
                <div class="bg-green-50 text-green-700 p-4 mb-8 text-[10px] font-black uppercase tracking-widest border border-green-100"><?php echo $success; ?></div>
            <?php endif; ?>

            <form method="POST" class="space-y-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Email Address</label>
                    <input type="email" name="email" value="<?php echo h($user['email']); ?>" required 
                        class="w-full border-b-2 border-gray-100 py-3 font-bold focus:outline-none focus:border-[#1E4033] text-sm">
                </div>

                <?php if ($user_type === 'buyer'): ?>
                    <div class="space-y-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Company Name</label>
                            <input type="text" name="company_name" value="<?php echo h($user['company_name']); ?>" required 
                                class="w-full border-b-2 border-gray-100 py-3 font-bold uppercase focus:outline-none focus:border-[#1E4033] text-sm">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Business Reg Number</label>
                            <input type="text" name="reg_number" value="<?php echo h($user['business_reg_number']); ?>" required 
                                class="w-full border-b-2 border-gray-100 py-3 font-bold focus:outline-none focus:border-[#1E4033] text-sm">
                        </div>
                    </div>

                <?php else: ?>
                    <div class="space-y-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Business Name</label>
                            <input type="text" name="business_name" value="<?php echo h($user['business_name']); ?>" required 
                                class="w-full border-b-2 border-gray-100 py-3 font-bold uppercase focus:outline-none focus:border-[#1E4033] text-sm">
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Farm Size (Ha)</label>
                                <input type="number" step="0.1" name="farm_size" value="<?php echo $user['farm_size']; ?>" required 
                                    class="w-full border-b-2 border-gray-100 py-3 font-bold focus:outline-none focus:border-[#1E4033] text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Certification</label>
                                <input type="text" name="cert_type" value="<?php echo h($user['certification_type']); ?>" required 
                                    class="w-full border-b-2 border-gray-100 py-3 font-bold uppercase focus:outline-none focus:border-[#1E4033] text-sm">
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <button type="submit" class="w-full bg-[#1E4033] text-white py-6 text-[11px] font-black uppercase tracking-[0.4em] hover:brightness-110 shadow-xl transition-all">
                    Save Changes
                </button>
            </form>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>