<!-- File: pages/user-management.php -->
<div id="user-management" class="page hidden bg-gray-100 p-6">
  <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Create New User Form -->
    <div class="bg-white shadow-lg rounded-lg p-6">
      <h2 class="text-2xl font-bold mb-4 text-gray-800">Create New User</h2>
      <form id="createUserForm" class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Full Name</label>
          <input type="text" name="full_name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" name="email" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" name="password" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Role</label>
          <select name="role" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">Select a role</option>
            <option value="admin">Admin</option>
            <option value="civil">Civil</option>
            <option value="ctr">CTR</option>
            <option value="subhead">Sub Head</option>
            <option value="safety">Safety</option>
            <option value="sai">SAI</option>
          </select>
        </div>
        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition">Create User</button>
      </form>
    </div>

    <!-- Existing Users Table -->
    <div class="bg-white shadow-lg rounded-lg p-6">
      <h2 class="text-2xl font-bold mb-4 text-gray-800">Existing Users</h2>
      <div class="overflow-x-auto">
        <table class="w-full table-auto text-left text-sm">
          <thead class="bg-gray-100">
            <tr>
              <th class="py-2 px-4">Name</th>
              <th class="py-2 px-4">Email</th>
              <th class="py-2 px-4">Role</th>
              <th class="py-2 px-4">Actions</th>
            </tr>
          </thead>
          <tbody id="usersTableBody">
            <!-- Dynamic rows populated via JS or PHP -->
            <tr>
              <td class="py-2 px-4">Admin User</td>
              <td class="py-2 px-4">admin@wap.com</td>
              <td class="py-2 px-4">admin</td>
              <td class="py-2 px-4">
                <button class="bg-blue-500 text-white px-2 py-1 rounded mr-2">Edit</button>
                <button class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
