<?php include '../includes/header.php'; ?>

<main class="min-h-screen bg-[#EAEFEF] py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col lg:flex-row gap-12">
            <div class="lg:w-1/3">
                <div class="bg-white border-[3px] border-white shadow-[0_0_40px_rgba(0,0,0,0.05)] p-10">
                    <h3 class="text-2xl font-black uppercase tracking-tighter text-gray-900 mb-8">Add Product</h3>
                    
                    <form action="process_product.php" method="POST" class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Product Name</label>
                            <input type="text" name="product_name" required class="w-full border-b-2 border-gray-100 py-2 font-bold uppercase tracking-widest focus:outline-none focus:border-[#1E4033] text-sm">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Unit Price (₱)</label>
                                <input type="number" step="0.01" name="unit_price" required class="w-full border-b-2 border-gray-100 py-2 font-bold uppercase tracking-widest focus:outline-none focus:border-[#1E4033] text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">MOQ</label>
                                <input type="number" name="moq" required class="w-full border-b-2 border-gray-100 py-2 font-bold uppercase tracking-widest focus:outline-none focus:border-[#1E4033] text-sm">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Category</label>
                            <select name="category_id" class="w-full border-b-2 border-gray-100 py-2 font-bold uppercase tracking-widest focus:outline-none focus:border-[#1E4033] text-sm bg-transparent">
                                <option value="">Select Category</option>
                                <option value="1">Fresh Produce</option>
                            </select>
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
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-8 py-6">
                                    <span class="block text-sm font-black uppercase tracking-tight text-gray-900">White Onion (Bulk)</span>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Fresh Produce</span>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="block text-sm font-bold text-[#1E4033]">₱120.00 / KG</span>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Min: 50 KG</span>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="px-3 py-1 bg-green-50 text-green-700 text-[9px] font-black uppercase tracking-widest">Active</span>
                                </td>
                                <td class="px-8 py-6 text-right space-x-4">
                                    <button class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-[#1E4033]">Edit</button>
                                    <button class="text-[10px] font-black uppercase tracking-widest text-red-400 hover:text-red-600">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>