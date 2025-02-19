<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    // Redirect to login page if session doesn't exist
    header("Location: waplogin.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Access Permit System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen">
    <div id="app" class="flex min-h-screen shadow-2xl">
        <!-- Sidebar -->
        <div class="w-64 bg-gradient-to-b from-gray-800 to-gray-900 text-white p-4 flex flex-col transition-all duration-300 hover:shadow-2xl">
            <div class="flex items-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mr-3 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                </svg>
                <h1 class="text-2xl font-bold text-blue-300">WAP System</h1>
            </div>
            <nav class="space-y-2 flex-grow">
                <button onclick="showPage('dashboard')" class="menu-btn flex items-center w-full p-3 hover:bg-gray-700 rounded-lg transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-blue-400 group-hover:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </button>
                <button onclick="showPage('create-wap')" class="menu-btn flex items-center w-full p-3 hover:bg-gray-700 rounded-lg transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-green-400 group-hover:text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Create New WAP
                </button>
                <button onclick="showPage('edit-wap')" class="menu-btn flex items-center w-full p-3 hover:bg-gray-700 rounded-lg transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-yellow-400 group-hover:text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Edit/Extend WAP
                </button>
                <button onclick="showPage('pending-wap')" class="menu-btn flex items-center w-full p-3 hover:bg-gray-700 rounded-lg transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-purple-400 group-hover:text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Pending WAP
                </button>
                <button onclick="showPage('user-management')" class="menu-btn flex items-center w-full p-3 hover:bg-gray-700 rounded-lg transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-indigo-400 group-hover:text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    User Management
                </button>
            </nav>
            
            <div class="mt-auto">
                <button onclick="logoutUser()" class="flex items-center w-full p-3 hover:bg-red-700 rounded-lg transition-all group text-red-400 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </div>
            
            <script>
                function logoutUser() {
                    window.location.href = 'logout.php'; // Redirects to logout.php to destroy session and log out
                }
            </script>
            
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 bg-white p-8 overflow-y-auto">


            <div id="dashboard" class="page bg-gray-100 p-6">
                <div class="max-w-7xl mx-auto">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-3xl font-semibold text-gray-800">WAP Management Dashboard</h1>
                        <div class="flex space-x-3">
                            <button class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">Export</button>
                            <button class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">Filters</button>
                        </div>
                    </div>
            
                    <!-- Metrics Cards -->
                    <div class="grid grid-cols-3 gap-6 mb-8">
                        <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-gray-500 uppercase tracking-wide text-sm mb-2">Total WAPs</h3>
                                    <p class="text-3xl font-bold text-gray-800">254</p>
                                </div>
                                <div class="bg-blue-100 p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4">
                                <span class="text-green-500 font-medium">+12.5%</span>
                                <span class="text-gray-500 text-sm ml-2">vs last month</span>
                            </div>
                        </div>

                        <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-gray-500 uppercase tracking-wide text-sm mb-2">Pending WAPs</h3>
                                    <p class="text-3xl font-bold text-gray-800">42</p>
                                </div>
                                <div class="bg-green-100 p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4">
                                <span class="text-red-500 font-medium">-3.2%</span>
                                <span class="text-gray-500 text-sm ml-2">vs last month</span>
                            </div>
                        </div>

                        <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-red-500 hover:shadow-xl transition">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-gray-500 uppercase tracking-wide text-sm mb-2">Expired WAPs</h3>
                                    <p class="text-3xl font-bold text-gray-800">13</p>
                                </div>
                                <div class="bg-red-100 p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4">
                                <span class="text-red-500 font-medium">+5.1%</span>
                                <span class="text-gray-500 text-sm ml-2">vs last month</span>
                            </div>
                        </div>
                    </div>
            
                    <!-- Charts Section -->
                    <div class="grid grid-cols-2 gap-6">
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-semibold text-gray-800">WAP Status Distribution</h2>
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm text-gray-500">This Month</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <canvas id="wapPieChart" class="h-64"></canvas>
                        </div>
        
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-semibold text-gray-800">WAPs by Department</h2>
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm text-gray-500">Quarterly</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <canvas id="deptBarChart" class="h-64"></canvas>
                        </div>
                    </div>
            
                    <div class="mt-6">
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-semibold text-gray-800">Monthly WAP Trends</h2>
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm text-gray-500">Year to Date</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <canvas id="monthlyWAPs" class="h-64"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <script>
            // Pie Chart
            var ctxPie = document.getElementById('wapPieChart').getContext('2d');
            new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: ['Approved', 'Pending', 'Rejected'],
                    datasets: [{
                        data: [180, 42, 32],
                        backgroundColor: ['#10B981', '#F59E0B', '#EF4444']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { 
                            position: 'bottom',
                            labels: {
                                boxWidth: 20,
                                padding: 20
                            }
                        }
                    }
                }
            });

            // Bar Chart
            var ctxBar = document.getElementById('deptBarChart').getContext('2d');
            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: ['HR', 'IT', 'Maintenance', 'Operations'],
                    datasets: [{
                        label: 'WAPs Issued',
                        data: [50, 70, 90, 44],
                        backgroundColor: ['#3B82F6', '#10B981', '#6366F1', '#F43F5E']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { 
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of WAPs'
                            }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });

            // Line Chart
            var ctxLine = document.getElementById('monthlyWAPs').getContext('2d');
            new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                    datasets: [{
                        label: 'WAPs Issued',
                        data: [15, 20, 25, 30, 35],
                        borderColor: '#6D28D9',
                        backgroundColor: 'rgba(109, 40, 217, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { 
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of WAPs'
                            }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
            </script>


            <!-- Create New WAP Page -->
            <div id="create-wap" class="page hidden">
                <h1 class="text-4xl font-bold mb-6">Create New Work Access Permit</h1>
                <div id="workpermit-container"></div>
            </div>


            <!-- Edit/Extend WAP Page -->
            <div id="edit-wap" class="page hidden">
                <h1 class="text-4xl font-bold mb-6">Edit/Extend WAP</h1>
                <div class="bg-gray-50 p-6 rounded-lg shadow">
                    <input type="text" placeholder="Search WAP" class="w-full p-2 border rounded mb-4">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="p-2 text-left">WAP ID</th>
                                <th class="p-2 text-left">Employee</th>
                                <th class="p-2 text-left">Expiry Date</th>
                                <th class="p-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-2">WAP-001</td>
                                <td class="p-2">John Doe</td>
                                <td class="p-2">30/09/2024</td>
                                <td class="p-2">
                                    <button class="bg-blue-500 text-white p-1 rounded">Extend</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pending WAP Page -->
            <div id="pending-wap" class="page hidden">
                <h1 class="text-4xl font-bold mb-6">Pending Work Access Permits</h1>
                <div class="bg-gray-50 p-6 rounded-lg shadow">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="p-2 text-left">WAP ID</th>
                                <th class="p-2 text-left">Employee</th>
                                <th class="p-2 text-left">Request Date</th>
                                <th class="p-2 text-left">Status</th>
                                <th class="p-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-2">WAP-042</td>
                                <td class="p-2">Jane Smith</td>
                                <td class="p-2">15/02/2024</td>
                                <td class="p-2">
                                    <span class="bg-yellow-100 text-yellow-800 p-1 rounded">Pending</span>
                                </td>
                                <td class="p-2">
                                    <button class="bg-green-500 text-white p-1 rounded mr-2">Approve</button>
                                    <button class="bg-red-500 text-white p-1 rounded">Reject</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- User Management Page -->
            <div id="user-management" class="page hidden">
                <div class="grid grid-cols-2 gap-8">
                    <!-- Create New User Form -->
                    <div class="bg-gradient-to-br from-white to-gray-50 p-6 rounded-2xl shadow-xl border border-gray-100">
                        <h2 class="text-3xl font-bold mb-6 text-gray-800 flex items-center">
                            Create New User
                        </h2>
                        <form class="space-y-5">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-600">Full Name</label>
                                    <input type="text" class="w-full px-4 py-2 border rounded-lg" placeholder="Enter full name" required>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-600">User ID</label>
                                    <input type="text" class="w-full px-4 py-2 border rounded-lg" placeholder="Create user ID" required>
                                </div>
                            </div>
                            <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600">
                                Create User
                            </button>
                        </form>
                    </div>


                     <!-- Existing Users List -->
                     <div class="bg-gradient-to-br from-white to-gray-50 p-6 rounded-2xl shadow-xl border border-gray-100">
                        <h2 class="text-3xl font-bold mb-6 text-gray-800">
                            Existing Users
                        </h2>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="p-3 text-left">User ID</th>
                                        <th class="p-3 text-left">Full Name</th>
                                        <th class="p-3 text-left">Department</th>
                                        <th class="p-3 text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b">
                                        <td class="p-3">JD001</td>
                                        <td class="p-3">John Doe</td>
                                        <td class="p-3">IT</td>
                                        <td class="p-3">
                                            <button class="bg-blue-500 text-white p-1 rounded mr-2">Edit</button>
                                            <button class="bg-red-500 text-white p-1 rounded">Delete</button>
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="p-3">JS002</td>
                                        <td class="p-3">Jane Smith</td>
                                        <td class="p-3">HR</td>
                                        <td class="p-3">
                                            <button class="bg-blue-500 text-white p-1 rounded mr-2">Edit</button>
                                            <button class="bg-red-500 text-white p-1 rounded">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Page navigation function
        function showPage(pageId) {
            // Hide all pages
            document.querySelectorAll('.page').forEach(page => {
                page.classList.add('hidden');
            });
    
            // Remove active state from all menu buttons
            document.querySelectorAll('.menu-btn').forEach(btn => {
                btn.classList.remove('bg-gray-700');
            });
    
            // Show selected page
            const selectedPage = document.getElementById(pageId);
            if (selectedPage) {
                selectedPage.classList.remove('hidden');
            }
    
            // Add active state to clicked menu button
            const activeButton = document.querySelector(`button[onclick="showPage('${pageId}')"]`);
            if (activeButton) {
                activeButton.classList.add('bg-gray-700');
            }
    
            // Load workpermit.html dynamically if Create WAP page is selected
            if (pageId === "create-wap") {
                fetch("workpermit.html")
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById("create-wap").innerHTML = data;
                    })
                    .catch(error => console.error("Error loading workpermit.html:", error));
            }
        }
    
        // Show dashboard by default
        showPage('dashboard');
    </script>
    
</body>
</html>