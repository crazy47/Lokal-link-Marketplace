<?php include '../includes/header.php'; ?>

<main class="min-h-screen bg-[#EAEFEF] py-24 px-4 flex items-center justify-center">
    <div class="w-full max-w-md bg-white border-[3px] border-white shadow-[0_0_40px_rgba(0,0,0,0.05)] p-10 md:p-14">
        
        <header class="mb-12 text-center">
            <h2 class="text-4xl font-black uppercase tracking-tighter text-gray-900 mb-2">Welcome Back</h2>
            <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-gray-400">Secure B2B Access</p>
        </header>

        <form action="process_login.php" method="POST" class="space-y-10">
            
            <div class="space-y-6">
                <div class="space-y-1">
                    <label class="text-sm font-medium text-gray-600">Email Address</label>
                    <input type="email" name="email" placeholder="Enter your business email" 
                        class="w-full border-b-2 border-gray-100 py-3 focus:outline-none focus:border-[#1E4033] transition-colors">
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-medium text-gray-600">Password</label>
                    <input type="password" name="password" placeholder="••••••••" 
                        class="w-full border-b-2 border-gray-100 py-3 focus:outline-none focus:border-[#1E4033] transition-colors">
                </div>

                <button type="submit" class="w-full bg-[#1E4033] text-white py-4 font-bold rounded-sm hover:bg-black transition-all">
                    Sign In to Your Account
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