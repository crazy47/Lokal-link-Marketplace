<?php 
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';

try {
    // We only show producers who have a 'verified' status
    $stmt = $pdo->prepare("
        SELECT business_name, farm_size, certification_type 
        FROM tbl_producerprofiles 
        WHERE verified_status = 'verified'
        ORDER BY business_name ASC
    ");
    $stmt->execute();
    $producers = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}

include 'includes/header.php'; 
?>

<main class="min-h-screen bg-[#EAEFEF] py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <header class="text-center mb-20">
            <h4 class="text-[10px] font-black uppercase tracking-[0.6em] text-gray-400 mb-4">The Backbone of Lokal-Link</h4>
            <h2 class="text-6xl font-black uppercase tracking-tighter text-gray-900 mb-6">Our Verified Producers</h2>
            <div class="w-24 h-2 bg-[#1E4033] mx-auto"></div>
        </header>

        <?php if (empty($producers)): ?>
            <div class="bg-white border-[3px] border-white p-20 text-center shadow-sm">
                <p class="text-sm font-bold uppercase tracking-widest text-gray-400">Currently onboarding new verified local partners.</p>
                </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <?php foreach ($producers as $producer): ?>
                <div class="group bg-white border-[3px] border-white p-10 shadow-[0_0_50px_rgba(0,0,0,0.03)] hover:shadow-xl transition-all duration-300">
                    <div class="flex justify-between items-start mb-8">
                        <div class="bg-[#1E4033] text-white p-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <span class="text-[9px] font-black uppercase tracking-widest text-[#1E4033] bg-green-50 px-3 py-1 border border-green-100">Verified Source</span>
                    </div>

                    <h3 class="text-2xl font-black uppercase tracking-tighter text-gray-900 mb-2"><?php echo h($producer['business_name']); ?></h3>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-8"><?php echo h($producer['certification_type']); ?></p>
                    
                    <div class="border-t border-gray-50 pt-8 flex justify-between items-center">
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-gray-400 mb-1">Land Area</p>
                            <p class="text-sm font-bold text-gray-900 uppercase"><?php echo number_format($producer['farm_size'], 1); ?> Hectares</p>
                        </div>
                        <a href="marketplace.php" class="text-[10px] font-black uppercase tracking-widest text-[#1E4033] border-b-2 border-[#1E4033] pb-1 hover:text-black hover:border-black transition-colors">View Produce</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>