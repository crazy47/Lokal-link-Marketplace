<?php include '../includes/header.php'; ?>

<main class="min-h-screen bg-[#EAEFEF] py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <header class="mb-12">
            <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 mb-2">Order Review</h4>
            <h2 class="text-4xl font-black uppercase tracking-tighter text-gray-900">Your Procurement Cart</h2>
        </header>

        <div class="flex flex-col lg:flex-row gap-12">
            <div class="lg:w-2/3 space-y-4">
                <div class="bg-white border-[3px] border-white shadow-[0_0_30px_rgba(0,0,0,0.03)] p-8 flex items-center justify-between">
                    <div class="flex items-center gap-6">
                        <div class="w-20 h-20 bg-gray-100 overflow-hidden">
                            <img src="../assets/uploads/backgroundhero.jpg" class="w-full h-full object-cover grayscale">
                        </div>
                        <div>
                            <h3 class="text-sm font-black uppercase tracking-widest text-gray-900 mb-1">Organic Highland Rice</h3>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Producer: Bulacan Farm Co.</p>
                        </div>
                    </div>
                    <div class="text-right space-y-2">
                        <span class="block text-sm font-black text-[#1E4033]">₱8,500.00</span>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">10 Sacks (MOQ)</span>
                    </div>
                </div>
            </div>

            <div class="lg:w-1/3">
                <div class="bg-[#1E4033] text-white p-10 shadow-[0_30px_60px_rgba(30,64,51,0.2)] space-y-10">
                    <h3 class="text-xl font-black uppercase tracking-widest border-b border-white/10 pb-4">Summary</h3>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between text-[10px] font-bold uppercase tracking-widest opacity-70">
                            <span>Subtotal</span>
                            <span>₱8,500.00</span>
                        </div>
                        <div class="flex justify-between text-[10px] font-bold uppercase tracking-widest opacity-70">
                            <span>Logistics (Direct)</span>
                            <span>Calculated at checkout</span>
                        </div>
                        <div class="pt-4 border-t border-white/10 flex justify-between items-end">
                            <span class="text-[10px] font-black uppercase tracking-widest">Total Amount</span>
                            <span class="text-2xl font-black tracking-tighter">₱8,500.00</span>
                        </div>
                    </div>

                    <button class="w-full bg-white text-[#1E4033] py-6 text-[10px] font-black uppercase tracking-[0.4em] hover:bg-gray-100 transition-all">
                        Complete Procurement
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>