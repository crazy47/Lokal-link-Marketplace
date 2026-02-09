<?php include '../includes/header.php'; ?>

<main class="min-h-screen bg-[#EAEFEF] py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <header class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
            <div class="space-y-1">
                <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400">Producer Portal</h4>
                <h2 class="text-4xl font-black uppercase tracking-tighter text-gray-900">Farm Dashboard</h2>
            </div>
            <a href="manage-products.php" class="bg-[#1E4033] text-white px-8 py-4 text-[10px] font-black uppercase tracking-[0.3em] hover:brightness-110 transition-all">
                + Add New Product
            </a>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white p-8 border-[3px] border-white shadow-[0_0_30px_rgba(0,0,0,0.03)]">
                <span class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Total Active Products</span>
                <span class="text-4xl font-black text-gray-900 tracking-tighter">12</span>
            </div>
            <div class="bg-white p-8 border-[3px] border-white shadow-[0_0_30px_rgba(0,0,0,0.03)]">
                <span class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Pending Orders</span>
                <span class="text-4xl font-black text-[#1E4033] tracking-tighter">04</span>
            </div>
            <div class="bg-white p-8 border-[3px] border-white shadow-[0_0_30px_rgba(0,0,0,0.03)]">
                <span class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Total Earnings</span>
                <span class="text-4xl font-black text-gray-900 tracking-tighter">₱42,500.00</span>
            </div>
        </div>

        <div class="bg-white border-[3px] border-white shadow-[0_0_30px_rgba(0,0,0,0.03)] overflow-hidden">
            <div class="p-8 border-b border-gray-50 flex justify-between items-center">
                <h3 class="text-sm font-black uppercase tracking-widest text-gray-900">Active Inventory</h3>
                <a href="manage-products.php" class="text-[10px] font-bold uppercase tracking-widest text-[#1E4033] border-b-2 border-[#1E4033] pb-1">View Full List</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-[10px] font-black uppercase tracking-widest text-gray-400">
                            <th class="px-8 py-4">Product Name</th>
                            <th class="px-8 py-4">Unit Price</th>
                            <th class="px-8 py-4">Stock</th>
                            <th class="px-8 py-4">MOQ</th>
                            <th class="px-8 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-6 text-sm font-bold uppercase tracking-tight text-gray-900">Organic Highland Rice</td>
                            <td class="px-8 py-6 text-sm font-bold text-gray-600">₱850.00</td>
                            <td class="px-8 py-6 text-sm font-bold text-gray-600">45 Sacks</td>
                            <td class="px-8 py-6 text-sm font-bold text-gray-600">10 Sacks</td>
                            <td class="px-8 py-6 text-right">
                                <button class="text-[10px] font-black uppercase tracking-widest text-[#1E4033] hover:opacity-70">Edit</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>