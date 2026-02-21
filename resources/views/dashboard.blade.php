<x-app-layout>
    <div class="p-6 lg:p-10 space-y-10">

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Active Listings</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">100</p>
                    </div>
                    <div class="bg-indigo-100 dark:bg-indigo-900/30 p-4 rounded-lg">
                        <i class="fa-solid fa-house-chimney text-3xl text-indigo-600 dark:text-indigo-400"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Views</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">8,420</p>
                    </div>
                    <div class="bg-green-100 dark:bg-green-900/30 p-4 rounded-lg">
                        <i class="fa-solid fa-eye text-3xl text-green-600 dark:text-green-400"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Pending Inquiries</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">7</p>
                    </div>
                    <div class="bg-yellow-100 dark:bg-yellow-900/30 p-4 rounded-lg">
                        <i class="fa-solid fa-envelope text-3xl text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Active Subscription</p>
                        <p class="text-xl font-bold text-indigo-600 dark:text-indigo-400 mt-1">Premium</p>
                    </div>
                    <div class="bg-purple-100 dark:bg-purple-900/30 p-4 rounded-lg">
                        <i class="fa-solid fa-crown text-3xl text-purple-600 dark:text-purple-400"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="/agent/login" class="bg-linear-to-r from-green-500 to-teal-600 text-white p-8 rounded-xl shadow-lg hover:shadow-2xl hover:scale-[1.02] transition-all duration-300 flex flex-col items-center justify-center text-center">
                <i class="fa-solid fa-house-chimney-window text-5xl mb-4"></i>
                <h3 class="text-2xl font-semibold">Add New Property</h3>
                <p class="mt-3 opacity-90 text-lg">List your house, land or apartment today</p>
            </a>

            <a href="#" class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow border border-gray-200 dark:border-gray-700 hover:shadow-2xl hover:scale-[1.02] transition-all duration-300 flex flex-col items-center justify-center text-center">
                <i class="fa-solid fa-heart text-5xl text-red-500 mb-4"></i>
                <h3 class="text-2xl font-semibold">My Favorites</h3>
                <p class="mt-3 text-gray-600 dark:text-gray-400 text-lg">View your saved properties</p>
            </a>

            <a href="#" class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow border border-gray-200 dark:border-gray-700 hover:shadow-2xl hover:scale-[1.02] transition-all duration-300 flex flex-col items-center justify-center text-center">
                <i class="fa-solid fa-bell text-5xl text-yellow-500 mb-4"></i>
                <h3 class="text-2xl font-semibold">Notifications</h3>
                <p class="mt-3 text-gray-600 dark:text-gray-400 text-lg">Check new messages & updates</p>
            </a>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Recent Activity</h2>
                <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm">View All</a>
            </div>
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                <div class="px-6 py-5 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">New inquiry received</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Someone asked about your property in Budhanilkantha
                            </p>
                        </div>
                        <span class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">2 hours ago</span>
                    </div>
                </div>
                <!-- Repeat similar blocks for more activity items -->
            </div>
        </div>

        <!-- Social Communication Links -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 p-8 text-center">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">
                Need Help? Connect With Us
            </h3>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                <a href="https://wa.me/9779765726294?text=Hello%20Lele%20Sasto%20Ghar" target="_blank" rel="noopener noreferrer"
                   class="flex flex-col items-center gap-3 p-5 bg-green-50 dark:bg-green-900/20 rounded-xl hover:bg-green-100 dark:hover:bg-green-900/30 transition-colors">
                    <i class="fab fa-whatsapp text-5xl text-green-500"></i>
                    <span class="font-medium text-green-700 dark:text-green-400">WhatsApp</span>
                </a>

                <a href="https://m.me/yourpage" target="_blank" rel="noopener noreferrer"
                   class="flex flex-col items-center gap-3 p-5 bg-blue-50 dark:bg-blue-900/20 rounded-xl hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors">
                    <i class="fab fa-facebook-messenger text-5xl text-blue-600"></i>
                    <span class="font-medium text-blue-700 dark:text-blue-400">Messenger</span>
                </a>

                <a href="mailto:info.lelesastogharjaggakarobar@gmail.com"
                   class="flex flex-col items-center gap-3 p-5 bg-red-50 dark:bg-red-900/20 rounded-xl hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors">
                    <i class="fas fa-envelope text-5xl text-red-500"></i>
                    <span class="font-medium text-red-700 dark:text-red-400">Email Us</span>
                </a>

                <a href="tel:+9779800000000"
                   class="flex flex-col items-center gap-3 p-5 bg-purple-50 dark:bg-purple-900/20 rounded-xl hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-colors">
                    <i class="fas fa-phone-volume text-5xl text-purple-600"></i>
                    <span class="font-medium text-purple-700 dark:text-purple-400">Call Now</span>
                </a>
            </div>
        </div>

    </div>
</x-app-layout>
