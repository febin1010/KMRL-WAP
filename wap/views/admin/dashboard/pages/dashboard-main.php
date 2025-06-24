<div id="dashboard" class="page bg-gray-100 p-4 md:p-6">
  <div class="max-w-7xl mx-auto">

    <!-- Enhanced Header with Date Picker -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
      <div>
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">WAP Management Dashboard</h1>
        <div class="flex items-center mt-2">
          <span class="text-sm text-gray-500 mr-2">Viewing data for:</span>
          <div class="relative">
            <input type="text" id="date-range" class="bg-white border border-gray-300 rounded-md px-3 py-1 text-sm cursor-pointer hover:border-blue-500 transition-colors" value="Last 30 days" readonly>
            <svg class="w-4 h-4 absolute right-3 top-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </div>
        </div>
      </div>
      <div class="flex space-x-3">
        <button class="export-btn bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-all transform hover:scale-105 flex items-center gap-2 shadow-md">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          Export
        </button>
        <button class="filters-btn bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-50 transition-all transform hover:scale-105 flex items-center gap-2 shadow-md">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
          </svg>
          Filters
          <span class="filter-badge bg-blue-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center hidden">3</span>
        </button>
      </div>
    </div>

    <!-- Interactive Metric Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
      <!-- Expiring Soon Card (Moved to first position) -->
      <div class="metric-card bg-white rounded-xl shadow-md p-5 border-l-4 border-orange-500 hover:shadow-lg transition-all cursor-pointer transform hover:-translate-y-1 relative overflow-hidden">
        <div class="absolute top-0 right-0 bg-orange-100 text-orange-800 text-xs font-medium px-2 py-1 rounded-bl-lg">Priority</div>
        <div class="flex justify-between items-center">
          <div>
            <h3 class="text-gray-500 text-sm uppercase font-medium mb-1">Expiring Soon</h3>
            <p class="text-2xl font-bold text-gray-800" id="expiringSoon">--</p>
          </div>
          <div class="bg-orange-100 p-3 rounded-full hover:bg-orange-200 transition-colors">
            <svg class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
        </div>
        <div class="mt-3">
          <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="expiring-progress bg-orange-500 h-2 rounded-full" style="width: 0%"></div>
          </div>
          <p class="text-xs text-gray-500 mt-1">Within next 7 days</p>
        </div>
      </div>

      <!-- Total WAPs Card -->
      <div class="metric-card bg-white rounded-xl shadow-md p-5 border-l-4 border-blue-500 hover:shadow-lg transition-all cursor-pointer transform hover:-translate-y-1">
        <div class="flex justify-between items-center">
          <div>
            <h3 class="text-gray-500 text-sm uppercase font-medium mb-1">Total WAPs</h3>
            <p class="text-2xl font-bold text-gray-800" id="totalWaps">--</p>
          </div>
          <div class="bg-blue-100 p-3 rounded-full hover:bg-blue-200 transition-colors">
            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
            </svg>
          </div>
        </div>
        <div class="mt-3">
          <div class="flex items-center">
            <span id="totalTrend" class="trend-indicator text-gray-500 font-medium flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
              </svg>
              --%
            </span>
            <span class="text-xs text-gray-500 ml-2">vs last month</span>
          </div>
        </div>
      </div>

      <!-- Pending WAPs Card -->
      <div class="metric-card bg-white rounded-xl shadow-md p-5 border-l-4 border-yellow-500 hover:shadow-lg transition-all cursor-pointer transform hover:-translate-y-1">
        <div class="flex justify-between items-center">
          <div>
            <h3 class="text-gray-500 text-sm uppercase font-medium mb-1">Pending WAPs</h3>
            <p class="text-2xl font-bold text-gray-800" id="pendingWaps">--</p>
          </div>
          <div class="bg-yellow-100 p-3 rounded-full hover:bg-yellow-200 transition-colors">
            <svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
            </svg>
          </div>
        </div>
        <div class="mt-3">
          <div class="flex items-center">
            <span id="pendingTrend" class="trend-indicator text-gray-500 font-medium flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
              </svg>
              --%
            </span>
            <span class="text-xs text-gray-500 ml-2">vs last month</span>
          </div>
        </div>
      </div>

      <!-- Expired WAPs Card -->
      <div class="metric-card bg-white rounded-xl shadow-md p-5 border-l-4 border-red-500 hover:shadow-lg transition-all cursor-pointer transform hover:-translate-y-1">
        <div class="flex justify-between items-center">
          <div>
            <h3 class="text-gray-500 text-sm uppercase font-medium mb-1">Expired WAPs</h3>
            <p class="text-2xl font-bold text-gray-800" id="expiredWaps">--</p>
          </div>
          <div class="bg-red-100 p-3 rounded-full hover:bg-red-200 transition-colors">
            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01" />
            </svg>
          </div>
        </div>
        <div class="mt-3">
          <div class="flex items-center">
            <span id="expiredTrend" class="trend-indicator text-gray-500 font-medium flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
              </svg>
              --%
            </span>
            <span class="text-xs text-gray-500 ml-2">vs last month</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Enhanced Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
      <!-- Interactive Pie Chart Card -->
      <div class="chart-card bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all">
        <div class="flex justify-between items-center mb-4">
          <div>
            <h2 class="text-lg font-semibold text-gray-800">WAP Status Distribution</h2>
            <p class="text-sm text-gray-500">Includes all WAPs till date</p>
          </div>
          <div class="relative">
            <button class="chart-menu-btn text-gray-400 hover:text-gray-600 p-1 rounded-full hover:bg-gray-100">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
              </svg>
            </button>
            <div class="chart-menu hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
              <div class="py-1">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">View Details</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Export Data</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Refresh</a>
              </div>
            </div>
          </div>
        </div>
        <div class="relative h-64">
          <canvas id="wapPieChart" class="w-full h-full"></canvas>
        </div>
        <div class="mt-4 grid grid-cols-2 gap-2">
          <div class="flex items-center">
            <div class="w-3 h-3 rounded-full bg-blue-500 mr-2"></div>
            <span class="text-xs text-gray-600">Approved</span>
          </div>
          <div class="flex items-center">
            <div class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></div>
            <span class="text-xs text-gray-600">Pending</span>
          </div>
          <div class="flex items-center">
            <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
            <span class="text-xs text-gray-600">Active</span>
          </div>
          <div class="flex items-center">
            <div class="w-3 h-3 rounded-full bg-red-500 mr-2"></div>
            <span class="text-xs text-gray-600">Expired</span>
          </div>
        </div>
      </div>

      <!-- Interactive Bar Chart Card -->
      <div class="chart-card bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all">
        <div class="flex justify-between items-center mb-4">
          <div>
            <h2 class="text-lg font-semibold text-gray-800">WAPs by Department</h2>
            <p class="text-sm text-gray-500">Currently active WAPs by department</p>
          </div>
          <div class="relative">
            <button class="chart-menu-btn text-gray-400 hover:text-gray-600 p-1 rounded-full hover:bg-gray-100">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
              </svg>
            </button>
            <div class="chart-menu hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
              <div class="py-1">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">View Details</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Export Data</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Refresh</a>
              </div>
            </div>
          </div>
        </div>
        <div class="relative h-64">
          <canvas id="deptBarChart" class="w-full h-full"></canvas>
        </div>
      </div>
    </div>

    <!-- Enhanced Line Chart Card -->
    <div class="chart-card bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all mb-6">
      <div class="flex justify-between items-center mb-4">
        <div>
          <h2 class="text-lg font-semibold text-gray-800">Monthly WAP Trends</h2>
          <p class="text-sm text-gray-500">Monthly WAP submission trends (this year)</p>
        </div>
        <div class="flex items-center gap-3">
          <div class="flex items-center">
            <div class="w-2 h-2 rounded-full bg-blue-500 mr-2"></div>
            <span class="text-xs text-gray-600">Submitted</span>
          </div>
          <div class="flex items-center">
            <div class="w-2 h-2 rounded-full bg-green-500 mr-2"></div>
            <span class="text-xs text-gray-600">Completed</span>
          </div>
          <div class="relative">
            <button class="chart-menu-btn text-gray-400 hover:text-gray-600 p-1 rounded-full hover:bg-gray-100">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
              </svg>
            </button>
            <div class="chart-menu hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
              <div class="py-1">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">View Details</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Export Data</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Refresh</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="relative h-72">
        <canvas id="monthlyWAPs" class="w-full h-full"></canvas>
      </div>
    </div>

  </div>
</div>

<!-- Simple JavaScript for interactive elements -->
<script>
  // Toggle chart menus
  document.querySelectorAll('.chart-menu-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const menu = btn.nextElementSibling;
      document.querySelectorAll('.chart-menu').forEach(m => {
        if (m !== menu) m.classList.add('hidden');
      });
      menu.classList.toggle('hidden');
    });
  });

  // Close menus when clicking elsewhere
  document.addEventListener('click', () => {
    document.querySelectorAll('.chart-menu').forEach(menu => {
      menu.classList.add('hidden');
    });
  });

  // Simulate loading data
  setTimeout(() => {
    document.getElementById('expiringSoon').textContent = '5';
    document.querySelector('.expiring-progress').style.width = '45%';
    document.getElementById('totalWaps').textContent = '1,248';
    document.getElementById('pendingWaps').textContent = '84';
    document.getElementById('expiredWaps').textContent = '27';
    document.getElementById('totalTrend').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>12.5%';
    document.getElementById('pendingTrend').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>3.2%';
    document.getElementById('expiredTrend').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>8.1%';
    document.getElementById('lastUpdated').textContent = new Date().toLocaleString();
    document.querySelector('.filter-badge').classList.remove('hidden');
  }, 1000);
</script>