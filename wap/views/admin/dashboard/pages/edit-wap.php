<div id="edit-wap" class="page hidden bg-gray-100 p-6">
  <div class="max-w-5xl mx-auto bg-white rounded-lg shadow-md p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Edit or Extend Work Access Permit</h1>

    <div class="mb-4">
      <input type="text" placeholder="Search WAP by ID or Licensee Name..." class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full bg-white shadow border border-gray-200 rounded-lg">
        <thead class="bg-gray-100 text-gray-700">
          <tr>
            <th class="py-3 px-4 text-left">WAP ID</th>
            <th class="py-3 px-4 text-left">Licensee</th>
            <th class="py-3 px-4 text-left">Station</th>
            <th class="py-3 px-4 text-left">Expiry Date</th>
            <th class="py-3 px-4 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Sample Row -->
          <tr class="border-t hover:bg-gray-50 transition">
            <td class="py-3 px-4">WAP-001</td>
            <td class="py-3 px-4">John Infrastructure</td>
            <td class="py-3 px-4">MG Road</td>
            <td class="py-3 px-4">2025-09-30</td>
            <td class="py-3 px-4">
              <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded mr-2">Edit</button>
              <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Extend</button>
            </td>
          </tr>
          <!-- Add more rows dynamically here -->
        </tbody>
      </table>
    </div>
  </div>
</div>
