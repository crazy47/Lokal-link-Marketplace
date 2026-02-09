<?php 
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Security Check
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../auth/login.php?error=unauthorized");
    exit();
}

// Fetch Metrics & Pending Producers
$pending_producers = $pdo->query("SELECT * FROM tbl_producerprofiles WHERE verified_status = 'pending'")->fetchAll();

include '../includes/header.php'; 
?>

<main class="min-h-screen bg-[#EAEFEF] py-16">
    <div class="max-w-6xl mx-auto px-4">
        <header class="mb-10">
            <h2 class="text-3xl font-black text-gray-900 tracking-tighter">Admin Control</h2>
            <p class="text-sm text-gray-500">Review and verify platform producers</p>
        </header>

        <div class="bg-white border-[3px] border-white shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-4 text-[10px] font-bold uppercase tracking-widest text-gray-400">Business Name</th>
                        <th class="px-8 py-4 text-[10px] font-bold uppercase tracking-widest text-gray-400">Farm Size</th>
                        <th class="px-8 py-4 text-[10px] font-bold uppercase tracking-widest text-gray-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php if (empty($pending_producers)): ?>
                        <tr><td colspan="3" class="px-8 py-10 text-center text-sm text-gray-400 italic">No pending verifications at this time.</td></tr>
                    <?php else: ?>
                        <?php foreach ($pending_producers as $p): ?>
                        <tr>
                            <td class="px-8 py-6 font-bold text-gray-900"><?php echo h($p['business_name']); ?></td>
                            <td class="px-8 py-6 text-sm text-gray-600"><?php echo $p['farm_size']; ?> Hectares</td>
                            <td class="px-8 py-6 text-right space-x-4">
                                <a href="process_verification.php?id=<?php echo $p['producer_id']; ?>&status=verified" class="text-xs font-bold text-green-600 hover:underline">Approve</a>
                                <a href="process_verification.php?id=<?php echo $p['producer_id']; ?>&status=rejected" class="text-xs font-bold text-red-400 hover:underline">Reject</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>