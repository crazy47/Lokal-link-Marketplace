<?php include '../includes/header.php'; ?>

<main class="min-h-screen bg-[#EAEFEF] flex items-center justify-center py-20 px-4">
    <div class="bg-white p-12 shadow-[0_0_60px_rgba(0,0,0,0.05)] border-[3px] border-white max-w-lg w-full">
        
        <header class="text-center mb-12">
            <h2 class="text-4xl font-black text-gray-900 tracking-tighter mb-2">Create Account</h2>
            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.3em]">Join the B2B Network</p>
        </header>

        <form action="process_register.php" method="POST" class="space-y-8">
            
            <div class="space-y-3">
                <label class="text-sm font-semibold text-gray-700">Account Type</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="border-2 border-gray-50 p-4 flex items-center justify-center cursor-pointer hover:border-[#1E4033] has-[:checked]:border-[#1E4033] has-[:checked]:bg-gray-50 transition-all">
                        <input type="radio" name="user_type" value="buyer" checked class="hidden">
                        <span class="text-xs font-bold text-gray-600">I am a Buyer</span>
                    </label>
                    <label class="border-2 border-gray-50 p-4 flex items-center justify-center cursor-pointer hover:border-[#1E4033] has-[:checked]:border-[#1E4033] has-[:checked]:bg-gray-50 transition-all">
                        <input type="radio" name="user_type" value="producer" class="hidden">
                        <span class="text-xs font-bold text-gray-600">I am a Producer</span>
                    </label>
                </div>
            </div>

            <div class="space-y-6">
                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">Business Name</label>
                    <input type="text" name="business_name" required placeholder="Your registered company name" 
                           class="w-full border-b-2 border-gray-100 py-3 focus:outline-none focus:border-[#1E4033] transition-colors placeholder:text-gray-300">
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">Email Address</label>
                    <input type="email" name="email" required placeholder="name@company.com" 
                           class="w-full border-b-2 border-gray-100 py-3 focus:outline-none focus:border-[#1E4033] transition-colors placeholder:text-gray-300">
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">Password</label>
                        <input type="password" name="password" required placeholder="••••••••" 
                               class="w-full border-b-2 border-gray-100 py-3 focus:outline-none focus:border-[#1E4033] transition-colors">
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">Confirm</label>
                        <input type="password" name="confirm_password" required placeholder="••••••••" 
                               class="w-full border-b-2 border-gray-100 py-3 focus:outline-none focus:border-[#1E4033] transition-colors">
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-[#1E4033] text-white py-5 font-bold uppercase tracking-widest hover:bg-black transition-all shadow-lg">
                Register Business
            </button>

            <p class="text-center text-xs text-gray-400">
                Already registered? <a href="login.php" class="text-[#1E4033] font-bold border-b border-[#1E4033]">Sign In</a>
            </p>
        </form>
    </div>
</main>

<?php include '../includes/footer.php'; ?>