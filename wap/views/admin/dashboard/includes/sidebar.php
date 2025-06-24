<div class="w-72 bg-gradient-to-b from-gray-800 to-gray-900 text-white p-6 flex flex-col transition-all duration-300 hover:shadow-2xl rounded-r-xl border-r border-gray-700">
    <div class="flex items-center mb-8">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mr-3 text-blue-400 hover:text-blue-300 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
        </svg>
        <div>
            <h1 class="text-2xl font-bold text-blue-300">WAP System</h1>
            <p class="text-xs text-gray-400">Administration Panel</p>
        </div>
    </div>
    
    <nav class="space-y-3 flex-grow">
        <button onclick="showPage('dashboard')" class="menu-btn flex items-center w-full p-3 hover:bg-gray-700 rounded-lg group transition-all duration-200 hover:translate-x-1">
            <div class="p-1.5 mr-3 rounded-md bg-gray-700 group-hover:bg-blue-600 transition-colors">
                <svg class="h-5 w-5 text-blue-400 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </div>
            <span class="font-medium text-gray-300 group-hover:text-white">Dashboard</span>
        </button>

        <button onclick="showPage('create-wap')" class="menu-btn flex items-center w-full p-3 hover:bg-gray-700 rounded-lg group transition-all duration-200 hover:translate-x-1">
            <div class="p-1.5 mr-3 rounded-md bg-gray-700 group-hover:bg-green-600 transition-colors">
                <svg class="h-5 w-5 text-green-400 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <span class="font-medium text-gray-300 group-hover:text-white">Create New WAP</span>
        </button>

        <button onclick="showPage('edit-wap')" class="menu-btn flex items-center w-full p-3 hover:bg-gray-700 rounded-lg group transition-all duration-200 hover:translate-x-1">
            <div class="p-1.5 mr-3 rounded-md bg-gray-700 group-hover:bg-yellow-600 transition-colors">
                <svg class="h-5 w-5 text-yellow-400 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <span class="font-medium text-gray-300 group-hover:text-white">Edit/Extend WAP</span>
        </button>

        <button onclick="showPage('pending-wap')" class="menu-btn flex items-center w-full p-3 hover:bg-gray-700 rounded-lg group transition-all duration-200 hover:translate-x-1">
            <div class="p-1.5 mr-3 rounded-md bg-gray-700 group-hover:bg-purple-600 transition-colors">
                <svg class="h-5 w-5 text-purple-400 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <span class="font-medium text-gray-300 group-hover:text-white">Pending WAP</span>
            <span class="ml-auto bg-purple-600 text-xs font-bold px-2 py-1 rounded-full">3</span>
        </button>

        <button onclick="showPage('user-management')" class="menu-btn flex items-center w-full p-3 hover:bg-gray-700 rounded-lg group transition-all duration-200 hover:translate-x-1">
            <div class="p-1.5 mr-3 rounded-md bg-gray-700 group-hover:bg-indigo-600 transition-colors">
                <svg class="h-5 w-5 text-indigo-400 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <span class="font-medium text-gray-300 group-hover:text-white">User Management</span>
        </button>
    </nav>

    <div class="mt-auto pt-4 border-t border-gray-700">
        <div class="flex items-center mb-4 px-2">
            <div class="relative">
                <img class="h-10 w-10 rounded-full border-2 border-blue-400" src="https://randomuser.me/api/portraits/men/32.jpg" alt="User profile">
                <span class="absolute bottom-0 right-0 h-3 w-3 bg-green-500 rounded-full border-2 border-gray-800"></span>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">Admin User</p>
                <p class="text-xs text-gray-400">admin@example.com</p>
            </div>
        </div>
        
        <button onclick="logoutUser()" class="flex items-center w-full p-3 hover:bg-red-700 rounded-lg group transition-colors duration-200 text-red-400 hover:text-white">
            <div class="p-1 mr-3 rounded-md bg-gray-700 group-hover:bg-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </div>
            <span class="font-medium">Logout</span>
        </button>
    </div>

    <script>
        function logoutUser() {
            window.location.href = '../../public/logout.php';
        }
    </script>
</div>