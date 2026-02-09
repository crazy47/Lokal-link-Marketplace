<?php 
include '../includes/db.php'; 
include '../includes/header.php'; 
?>

<main class="min-h-screen bg-[#EAEFEF] py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <header class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div class="space-y-2">
                <h4 class="text-xs font-black uppercase tracking-[0.4em] text-producer-green">B2B Inventory</h4>
                <h2 class="text-4xl font-black uppercase tracking-tighter text-gray-900">Current Marketplace</h2>
            </div>
            
            <div class="flex gap-2">
                <select class="bg-white border-2 border-white px-4 py-3 text-[10px] font-black uppercase tracking-widest focus:outline-none focus:border-producer-green shadow-sm">
                    <option>All Categories</option>
                    <option>Fresh Produce</option>
                    <option>Grains</option>
                </select>
                <input type="text" placeholder="Search Products..." 
                    class="bg-white border-2 border-white px-4 py-3 text-[10px] font-black uppercase tracking-widest focus:outline-none focus:border-producer-green shadow-sm w-64">
            </div>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <div class="bg-white border-[3px] border-white shadow-[0_0_30px_rgba(0,0,0,0.03)] group transition-all">
                <div class="aspect-square relative overflow-hidden bg-gray-100">
                    <img src="../assets/uploads/backgroundhero.jpg" alt="Product" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                    <div class="absolute top-0 left-0 bg-producer-green text-white px-3 py-1 text-[9px] font-black uppercase tracking-tighter z-10">
                        Verified Source
                    </div>
                </div>

                <div class="p-6 space-y-4">
                    <div>
                        <h3 class="text-sm font-black uppercase tracking-widest text-gray-900 mb-1">Organic Highland Rice</h3>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Bulacan Farm Co.</p>
                    </div>

                    <div class="pt-4 border-t border-gray-50 flex justify-between items-end">
                        <div class="space-y-1">
                            <span class="block text-[9px] font-black text-gray-400 uppercase tracking-tighter">Unit Price</span>
                            <span class="text-lg font-black text-producer-green">₱850.00</span>
                        </div>
                        <div class="text-right space-y-1">
                            <span class="block text-[9px] font-black text-gray-400 uppercase tracking-tighter">MOQ</span>
                            <span class="text-xs font-bold text-gray-900 uppercase">10 Sacks</span>
                        </div>
                    </div>

                    <a href="product_details.php" class="block w-full bg-[#1E4033] text-white py-4 text-center text-[10px] font-black uppercase tracking-[0.3em] hover:brightness-110 transition-all">
                        View Details
                    </a>
                </div>
            </div>
            
            </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>