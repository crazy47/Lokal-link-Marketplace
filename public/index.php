<?php 
include 'includes/db.php'; 
include 'includes/header.php'; 
?>

<main>
            <!-- HERO SECTION-->

    <section class="bg-white py-20 border-b border-gray-100 relative">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('assets/uploads/backgroundhero.jpg');"></div>
        
        <!-- Optional: Add overlay for better text readability -->
        <div class="absolute inset-0 bg-white/80"></div>
        
        <!-- Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row items-center justify-between gap-12">
                
                <div class="md:w-1/2 space-y-8">
                    <h1 class="text-5xl md:text-6xl font-black uppercase tracking-tighter leading-none text-gray-900">
                        Direct from <br>
                        <span class="text-producer-green">Local Producers</span>
                    </h1>
                    <p class="text-xl text-gray-600 max-w-lg font-medium leading-relaxed">
                        The B2B marketplace that removes the middleman. Empowering local farms and businesses with transparent pricing and direct logistics.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="auth/register.php" class="bg-producer-green text-white px-10 py-5 text-sm font-bold uppercase tracking-widest hover:brightness-110 transition-all text-center">
                            Join as Producer
                        </a>
                        <a href="buyer/marketplace.php" class="border-2 border-gray-900 text-gray-900 px-10 py-5 text-sm font-bold uppercase tracking-widest hover:bg-gray-900 hover:text-white transition-all text-center">
                            Browse Marketplace
                        </a>
                    </div>
                </div>

                <!-- Empty div to maintain layout (optional) -->
                <div class="md:w-1/2"></div>

            </div>
        </div>
    </section>

    <section class="bg-producer-green text-white py-12">
        <div class="max-w-7xl mx-auto px-4 flex flex-wrap justify-around gap-8 text-center">
            <div>
                <span class="block text-4xl font-bold">0%</span>
                <span class="text-xs uppercase tracking-widest opacity-80">Middleman Markup</span>
            </div>
            <div>
                <span class="block text-4xl font-bold uppercase tracking-tighter">Verified</span>
                <span class="text-xs uppercase tracking-widest opacity-80">Producer Status</span>
            </div>
            <div>
                <span class="block text-4xl font-bold uppercase tracking-tighter">Direct</span>
                <span class="text-xs uppercase tracking-widest opacity-80">B2B Transactions</span>
            </div>
        </div>
    </section>

    <section class="bg-white py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-4">
                <div class="space-y-2">
                    <h4 class="text-xs font-black uppercase tracking-[0.4em] text-gray-400">Inventory</h4>
                    <h2 class="text-4xl font-black uppercase tracking-tighter text-gray-900">Browse Categories</h2>
                </div>
                <a href="buyer/marketplace.php" class="text-sm font-bold uppercase tracking-widest border-b-2 border-[#1E4033] pb-1 text-[#1E4033] hover:opacity-70 transition-opacity">
                    View All Categories →
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-0 border-t border-l border-gray-100">
                
                <div class="group relative aspect-square overflow-hidden border-r border-b border-gray-100 cursor-pointer">
                    <img src="assets/uploads/backgroundhero.jpg" alt="Produce" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent z-10"></div>
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1E4033]/95 via-[#1E4033]/80 to-[#1E4033]/30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-20"></div>
                    
                    <div class="relative z-30 p-10 h-full flex flex-col justify-end">
                        <h3 class="text-lg font-black uppercase tracking-widest text-white mb-4 drop-shadow-sm">Fresh Produce</h3>
                        <p class="text-sm text-white/90 font-bold uppercase tracking-wider drop-shadow-sm">Direct from local farms</p>
                    </div>
                </div>

                <div class="group relative aspect-square overflow-hidden border-r border-b border-gray-100 cursor-pointer">
                    <img src="assets/uploads/livestock.webp" alt="Livestock" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent z-10"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1E4033]/95 via-[#1E4033]/80 to-[#1E4033]/30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-20"></div>
                    <div class="relative z-30 p-10 h-full flex flex-col justify-end">
                        <h3 class="text-lg font-black uppercase tracking-widest text-white mb-4 drop-shadow-sm">Livestock</h3>
                        <p class="text-sm text-white/90 font-bold uppercase tracking-wider drop-shadow-sm">Verified healthy stock</p>
                    </div>
                </div>

                <div class="group relative aspect-square overflow-hidden border-r border-b border-gray-100 cursor-pointer">
                    <img src="assets/uploads/rice.avif" alt="Rice" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent z-10"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1E4033]/95 via-[#1E4033]/80 to-[#1E4033]/30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-20"></div>
                    <div class="relative z-30 p-10 h-full flex flex-col justify-end">
                        <h3 class="text-lg font-black uppercase tracking-widest text-white mb-4 drop-shadow-sm">Grains & Rice</h3>
                        <p class="text-sm text-white/90 font-bold uppercase tracking-wider drop-shadow-sm">Bulk wholesale supply</p>
                    </div>
                </div>

                <div class="group relative aspect-square overflow-hidden border-r border-b border-gray-100 cursor-pointer">
                    <img src="assets/uploads/fishery.jpg" alt="Fishery" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent z-10"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1E4033]/95 via-[#1E4033]/80 to-[#1E4033]/30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-20"></div>
                    <div class="relative z-30 p-10 h-full flex flex-col justify-end">
                        <h3 class="text-lg font-black uppercase tracking-widest text-white mb-4 drop-shadow-sm">Fishery</h3>
                        <p class="text-sm text-white/90 font-bold uppercase tracking-wider drop-shadow-sm">Fresh local catch</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-[#EAEFEF] py-24 border-t-5 border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-32">
            
            <div class="text-center max-w-3xl mx-auto space-y-4">
                <h4 class="text-xs font-black uppercase tracking-[0.5em] text-[#1E4033]">Our Infrastructure</h4>
                <h2 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-gray-900 leading-none">
                    The Direct-to-Business <br> Ecosystem
                </h2>
            </div>

            <div class="flex flex-col md:flex-row items-center gap-16 lg:gap-24">
                <div class="w-full md:w-1/2 aspect-[4/3] relative border-[10px] border-white shadow-[0_0_40px_rgba(0,0,0,0.1)] overflow-hidden">
                    <img src="assets/uploads/inventory-listing.jpg" alt="Direct Listing" class="w-full h-full object-cover">
                    <div class="absolute top-0 left-0 bg-[#1E4033] text-white px-6 py-3 text-sm font-black tracking-widest uppercase z-10">01</div>
                </div>
                <div class="w-full md:w-1/2 space-y-6">
                    <h3 class="text-3xl font-black uppercase tracking-tight text-gray-900">Direct Producer Listing</h3>
                    <p class="text-gray-500 text-sm font-bold uppercase tracking-widest leading-relaxed">
                        Local producers list their inventory directly on our platform. No brokers, no hidden fees. Each producer is verified to ensure supply chain integrity and quality standards.
                    </p>
                    <div class="pt-4">
                        <a href="auth/register.php" class="inline-block border-b-2 border-[#1E4033] pb-1 text-xs font-black uppercase tracking-[0.2em] text-[#1E4033] hover:opacity-70 transition-opacity">Learn More →</a>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row-reverse items-center gap-16 lg:gap-24">
                <div class="w-full md:w-1/2 aspect-[4/3] relative border-[10px] border-white shadow-[0_0_40px_rgba(0,0,0,0.1)] overflow-hidden">
                    <img src="assets/uploads/procurement.jpg" alt="B2B Procurement" class="w-full h-full object-cover">
                    <div class="absolute top-0 right-0 bg-[#1E4033] text-white px-6 py-3 text-sm font-black tracking-widest uppercase z-10">02</div>
                </div>
                <div class="w-full md:w-1/2 space-y-6">
                    <h3 class="text-3xl font-black uppercase tracking-tight text-gray-900 text-right md:text-left">Simplified Procurement</h3>
                    <p class="text-gray-500 text-sm font-bold uppercase tracking-widest leading-relaxed text-right md:text-left">
                        Businesses browse verified categories and place bulk orders based on real-time stock levels. Our transparent pricing model shows exactly what the producer earns.
                    </p>
                    <div class="pt-4 flex justify-end md:justify-start">
                        <a href="buyer/marketplace.php" class="inline-block border-b-2 border-[#1E4033] pb-1 text-xs font-black uppercase tracking-[0.2em] text-[#1E4033] hover:opacity-70 transition-opacity">Explore Marketplace →</a>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row items-center gap-16 lg:gap-24">
                <div class="w-full md:w-1/2 aspect-[4/3] relative border-[10px] border-white shadow-[0_0_40px_rgba(0,0,0,0.1)] overflow-hidden">
                    <img src="assets/uploads/logistics.avif" alt="Direct Logistics" class="w-full h-full object-cover">
                    <div class="absolute top-0 left-0 bg-[#1E4033] text-white px-6 py-3 text-sm font-black tracking-widest uppercase z-10">03</div>
                </div>
                <div class="w-full md:w-1/2 space-y-6">
                    <h3 class="text-3xl font-black uppercase tracking-tight text-gray-900">Direct-to-Source Logistics</h3>
                    <p class="text-gray-500 text-sm font-bold uppercase tracking-widest leading-relaxed">
                        By removing the middleman warehouse, goods move faster and arrive fresher. We provide the digital tools to coordinate logistics directly from the producer's location.
                    </p>
                    <div class="pt-4">
                        <a href="auth/register.php" class="inline-block border-b-2 border-[#1E4033] pb-1 text-xs font-black uppercase tracking-[0.2em] text-[#1E4033] hover:opacity-70 transition-opacity">Get Started →</a>
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>