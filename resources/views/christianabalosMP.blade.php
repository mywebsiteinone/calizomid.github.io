<!-- resources/views/christianabalosMP.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .active {
            font-weight: bold;
            text-decoration: underline;
            border-bottom: 2px solid white;
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
            <a href="{{ route('abalos-users.index') }}" class="text-white flex items-center hover:underline">
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
<a href="{{ route('posts.home') }}" class="text-white flex items-center hover:underline {{ request()->routeIs('posts.home') ? 'active' : '' }}">
    <i class="fas fa-cogs mr-1"></i>
    Manage Post
</a>
        </div>
        <div class="ml-auto">
            <span class="text-white mr-4">
                Admin: {{ Auth::user()->name }}
            </span>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="background-color: red; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">Logout</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

        </div>
    </nav>
    <div class="container mx-auto">
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-4">Posts List</h2>
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center">
                    <label for="recordsPerPage" class="mr-2">Display</label>
                    <select id="recordsPerPage" class="border rounded p-1" onchange="this.form.submit()">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="ml-2">records per page</span>
                </div>
                <div>
                    <form action="{{ route('posts.index') }}" method="GET">
                        <label for="filterRecords" class="mr-2">Filter records:</label>
                        <input type="text" id="filterRecords" name="filter" class="border rounded p-1" value="{{ request('filter') }}">
                        <button type="submit" class="ml-2 bg-blue-500 text-white px-2 py-1 rounded">Filter</button>
                    </form>
                </div>
            </div>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">ID</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Title</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Content</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Status</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
    @foreach($posts as $post)
        <tr>
            <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $post->id }}</td>
            <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $post->title }}</td>
            <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $post->content }}</td>
            <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ ucfirst($post->status) }}</td>
            <td class="py-2 px-4 border-b border-gray-200 text-sm">
            <form action="{{ route('posts.updateStatus', $post->id) }}" method="POST">
    @csrf
    @method('PATCH') <!-- This will spoof the PATCH method -->
    <select name="status">
        <option value="accepted">Accept</option>
        <option value="rejected">Reject</option>
    </select>
    <button type="submit">Update Status</button>
</form>
            </td>
        </tr>
    @endforeach
</tbody>
            </table>
            <div class="flex justify-between items-center mt-4">
                <div class="text-sm text-gray-600">Showing page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}</div>
                <div class="flex items-center">
                    {{ $posts->links() }} <!-- Pagination links -->
                </div>
            </div>
        </div>
    </div>
</body>
</html>
