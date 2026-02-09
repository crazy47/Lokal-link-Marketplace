<?php include '../includes/header.php'; ?>

<main class="min-h-screen bg-[#EAEFEF] py-24 px-4 flex items-center justify-center">
    <div class="w-full max-w-md bg-white border-[3px] border-white shadow-[0_0_40px_rgba(0,0,0,0.05)] p-10 md:p-14">
        
        <header class="mb-12 text-center">
            <h2 class="text-4xl font-black uppercase tracking-tighter text-gray-900 mb-2">Welcome Back</h2>
            <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-gray-400">Secure B2B Access</p>
        </header>

        <form action="process_login.php" method="POST" class="space-y-10">
            
            <div class="space-y-6">
                <div class="group">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-1 group-focus-within:text-[#1E4033] transition-colors">Email Address</label>
                    <input type="email" name="email" required 
                        class="w-full border-b-2 border-gray-100 py-3 text-sm font-bold focus:outline-none focus:border-[#1E4033] uppercase tracking-widest placeholder:text-gray-200 transition-all">
                </div>
                
                <div class="group">
                    <div class="flex justify-between items-end mb-1">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 group-focus-within:text-[#1E4033] transition-colors">Password</label>
                        <a href="#" class="text-[9px] font-bold uppercase tracking-widest text-gray-400 hover:text-[#1E4033]">Forgot?</a>
                    </div>
                    <input type="password" name="password" required 
                        class="w-full border-b-2 border-gray-100 py-3 text-sm font-bold focus:outline-none focus:border-[#1E4033] uppercase tracking-widest placeholder:text-gray-200 transition-all">
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-[#1E4033] text-white py-6 text-xs font-black uppercase tracking-[0.4em] hover:brightness-110 transition-all">
                    Sign In to Portal
                </button>
            </div>
        </form>

        <footer class="mt-12 text-center">
            <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400">
                New to the platform? <a href="register.php" class="text-[#1E4033] border-b border-[#1E4033] ml-1">Create Account</a>
            </p>
        </footer>
    </div>
</main>

<?php include '../includes/footer.php'; ?>