<?php include '../includes/header.php'; ?>

<main class="min-h-screen bg-[#EAEFEF] py-20 px-4">
    <div class="max-w-xl mx-auto bg-white border-[3px] border-white shadow-[0_0_40px_rgba(0,0,0,0.05)] p-10 md:p-16">
        
        <header class="mb-10 text-center">
            <h2 class="text-4xl font-black uppercase tracking-tighter text-gray-900 mb-2">Create Account</h2>
            <p class="text-xs font-bold uppercase tracking-[0.3em] text-gray-400">Join the B2B Network</p>
        </header>

        <form action="process_register.php" method="POST" class="space-y-8">
            
            <div class="grid grid-cols-2 border-2 border-gray-100">
                <label class="cursor-pointer">
                    <input type="radio" name="user_type" value="buyer" class="peer hidden" checked onchange="toggleFields('buyer')">
                    <div class="py-4 text-center text-[10px] font-black uppercase tracking-widest peer-checked:bg-[#1E4033] peer-checked:text-white transition-all">
                        I am a Buyer
                    </div>
                </label>
                <label class="cursor-pointer">
                    <input type="radio" name="user_type" value="producer" class="peer hidden" onchange="toggleFields('producer')">
                    <div class="py-4 text-center text-[10px] font-black uppercase tracking-widest peer-checked:bg-[#1E4033] peer-checked:text-white transition-all">
                        I am a Producer
                    </div>
                </label>
            </div>

            <div class="space-y-4">
                <input type="email" name="email" placeholder="EMAIL ADDRESS" required 
                    class="w-full border-b-2 border-gray-200 py-4 text-sm font-bold focus:outline-none focus:border-[#1E4033] uppercase tracking-widest placeholder:text-gray-300">
                
                <input type="password" name="password" placeholder="PASSWORD" required 
                    class="w-full border-b-2 border-gray-200 py-4 text-sm font-bold focus:outline-none focus:border-[#1E4033] uppercase tracking-widest placeholder:text-gray-300">
            </div>

            <div id="buyer-fields" class="space-y-4">
                <input type="text" name="company_name" placeholder="COMPANY NAME" 
                    class="w-full border-b-2 border-gray-200 py-4 text-sm font-bold focus:outline-none focus:border-[#1E4033] uppercase tracking-widest placeholder:text-gray-300">
                <input type="text" name="business_reg_number" placeholder="BUSINESS REG #" 
                    class="w-full border-b-2 border-gray-200 py-4 text-sm font-bold focus:outline-none focus:border-[#1E4033] uppercase tracking-widest placeholder:text-gray-300">
            </div>

            <div id="producer-fields" class="hidden space-y-4">
                <input type="text" name="business_name" placeholder="FARM / BUSINESS NAME" 
                    class="w-full border-b-2 border-gray-200 py-4 text-sm font-bold focus:outline-none focus:border-[#1E4033] uppercase tracking-widest placeholder:text-gray-300">
                <input type="number" step="0.01" name="farm_size" placeholder="FARM SIZE (HECTARES)" 
                    class="w-full border-b-2 border-gray-200 py-4 text-sm font-bold focus:outline-none focus:border-[#1E4033] uppercase tracking-widest placeholder:text-gray-300">
                <input type="text" name="certification_type" placeholder="CERTIFICATION (e.g. Organic, GAP)" 
                    class="w-full border-b-2 border-gray-200 py-4 text-sm font-bold focus:outline-none focus:border-[#1E4033] uppercase tracking-widest placeholder:text-gray-300">
            </div>

            <button type="submit" class="w-full bg-[#1E4033] text-white py-6 text-xs font-black uppercase tracking-[0.4em] hover:brightness-110 transition-all">
                Create Account
            </button>
        </form>

        <p class="mt-8 text-center text-[10px] font-bold uppercase tracking-widest text-gray-400">
            Already have an account? <a href="login.php" class="text-[#1E4033] border-b border-[#1E4033]">Sign In</a>
        </p>
    </div>
</main>

<script>
function toggleFields(type) {
    const buyer = document.getElementById('buyer-fields');
    const producer = document.getElementById('producer-fields');
    if(type === 'producer') {
        buyer.classList.add('hidden');
        producer.classList.remove('hidden');
    } else {
        buyer.classList.remove('hidden');
        producer.classList.add('hidden');
    }
}
</script>

<?php include '../includes/footer.php'; ?>