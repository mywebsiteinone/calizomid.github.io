<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .active {
            font-weight: bold;
            text-decoration: underline;
            border-bottom: 2px solid white;
        }
        .table-container {
            display: inline-block;
            width: 100%;
            overflow-x: auto;
        }
    </style>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-500 p-4 flex items-center">
        <div class="text-white text-xl font-bold flex items-center">
            <i class="fas fa-tachometer-alt mr-2"></i>
            Dashboard
        </div>
        <div class="ml-8 flex space-x-4">
            <a href="{{ route('admin.dashboard') }}" class="text-white flex items-center hover:underline">
                <i class="fas fa-home mr-1"></i>
                Dashboard
            </a>
            <a href="{{ route('abalos-users.index') }}" class="text-white flex items-center hover:underline active">
                <i class="fas fa-users mr-1"></i>
                Users
            </a>
            <a href="{{ route('abalos-categories.index') }}" class="text-white flex items-center hover:underline">
                <i class="fas fa-list mr-1"></i>
                Categories
            </a>
            <a href="{{ route('abalos-products.index') }}" class="text-white flex items-center hover:underline">
                <i class="fas fa-box mr-1"></i>
                Products
            </a>
            <a href="{{ route('abalos.chart') }}" class="text-white flex items-center hover:underline">
    <i class="fas fa-chart-line mr-1"></i>
    Reports
</a>
<a href="{{ route('posts.home') }}" class="text-white flex items-center hover:underline">
    <i class="fas fa-cogs mr-1"></i>
    Manage Post
</a>
        </div>
        <div class="ml-auto flex items-center">
            <span class="text-white mr-4">
                Admin: {{ Auth::user()->name }}
            </span>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700 transition duration-300">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </nav>  
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Users</h1>

        <!-- User Creation/Editing Form -->
        <!-- User Creation/Editing Form -->
<!-- User Creation/Editing Form -->
<h2 class="text-xl font-semibold mb-2">{{ isset($editUser) ? 'Edit User' : 'Create User' }}</h2>
<form action="{{ isset($editUser) ? route('abalos-users.update', $editUser->id) : route('abalos-users.store') }}" method="POST" class="bg-white p-4 rounded shadow-md mb-6">
    @csrf
    @if(isset($editUser))
        @method('PUT')
    @endif
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
        <input type="text" id="name" name="name" value="{{ isset($editUser) ? $editUser->name : '' }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" placeholder="Enter user name">
    </div>
    <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
        <input type="email" id="email" name="email" value="{{ isset($editUser) ? $editUser->email : '' }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" placeholder="Enter user email">
    </div>
    <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
        <input type="password" id="password" name="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" placeholder="{{ isset($editUser) ? 'Leave blank to keep the current password' : 'Enter password' }}" {{ isset($editUser) ? '' : 'required' }}>
    </div>
    <div class="mb-4">
    <label for="role" class="block text-sm font-medium text-gray-700">Role:</label>
    <select id="role" name="role" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500">
        <option value="" disabled {{ isset($editUser) && $editUser->role == '' ? 'selected' : '' }}>Select user role</option>
        <option value="admin" {{ isset($editUser) && $editUser->role == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="user" {{ isset($editUser) && $editUser->role == 'user' ? 'selected' : '' }}>User</option>
    </select>
</div>
<div class="mb-4">
    <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
    <select name="status" id="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500">
        <option value="active" {{ isset($editUser) && $editUser->status == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ isset($editUser) && $editUser->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
        <!-- Add more status options as needed -->
    </select>
</div>


    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
        {{ isset($editUser) ? 'Update' : 'Create' }}
    </button>
</form>




        <!-- Search Bar -->
        <div class="mb-4">
            <form action="{{ route('abalos-users.index') }}" method="GET" class="flex items-center">
                <input type="text" name="search" placeholder="Search by name" value="{{ request('search') }}" class="border border-gray-300 rounded-md p-2 w-full mr-2" />
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300">Search</button>
            </form>
        </div>

        <!-- User List -->
       <!-- User List -->
<h2 class="text-xl font-semibold mb-2">User List:</h2>
@if (isset($users) && $users->count())
    <div class="table-container">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Password</th>
                    <th class="py-2 px-4 border-b">Role</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->password }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->role }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->status }}</td>
                        <td class="py-2 px-4 border-b">
                            <div class="flex space-x-2">
                                <a href="{{ route('abalos-users.edit', $user->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('abalos-users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Controls -->
    <div class="mt-4 flex justify-between">
        <div>
            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users
        </div>
        <div>
            {{ $users->links() }}
        </div>
    </div>
@else
    <p class="mt-4 text-gray-600">No users found.</p>
@endif
