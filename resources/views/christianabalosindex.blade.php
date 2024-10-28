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
        /* Modal styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 100; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(0,0,0,0.4); 
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <nav class="bg-blue-500 p-4 flex items-center">
        <div class="text-white text-xl font-bold flex items-center">
            <i class="fas fa-tachometer-alt mr-2"></i>
            Dashboard
        </div>
        <div class="ml-8 flex space-x-4">
            <a href="{{ route('user.dashboard') }}" class="text-white flex items-center hover:underline {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <i class="fas fa-user mr-1"></i>
                Profile
            </a>
            <a href="{{ route('posts.index') }}" class="text-white flex items-center hover:underline">
                <i class="fas fa-list mr-1"></i>
                All Posts
            </a>
            <a href="{{ route('posts.create') }}" class="text-white flex items-center hover:underline">
                <i class="fas fa-plus-circle mr-1"></i>
                Add Post
            </a>
            <a href="{{ route('manage.index') }}" class="text-white flex items-center hover:underline {{ request()->routeIs('manage.index') ? 'active' : '' }}">
                <i class="fas fa-cogs mr-1"></i>
                Manage Post
            </a>
        </div>
        <div class="ml-auto">
            <span class="text-white mr-4">User: {{ Auth::user()->name }}</span>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="bg-red-500 text-white py-2 px-4 rounded">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </nav>

    <main class="flex-grow container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Posts</h1>
        @if(session('success'))
            <div class="mb-4 text-green-500">{{ session('success') }}</div>
        @endif

        <div class="flex flex-wrap -mx-2">
            @foreach($posts as $post)
                <div class="w-full md:w-1/2 lg:w-1/3 p-2">
                    <div class="bg-white border rounded shadow p-4">
                        <h2 class="font-bold text-lg">{{ $post->title }}</h2>
                        <p class="mb-2">{{ $post->content }}</p>
                        <div class="flex justify-between">
                            <button onclick="openModal({{ json_encode($post) }})" class="bg-blue-500 text-white py-1 px-3 rounded">Edit</button>
                            <form action="{{ route('manage.destroy', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <!-- Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content mx-auto my-20 p-6 bg-white rounded shadow-lg w-11/12 md:w-1/3">
            <span class="cursor-pointer text-gray-500 float-right" onclick="closeModal()">&times;</span>
            <h2 class="text-xl font-bold mb-4">Edit Post</h2>
            <form id="editForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="title" class="block mb-2">Title</label>
                    <input type="text" class="border rounded w-full p-2" id="modalTitle" name="title" required>
                </div>
                <div class="mb-4">
                    <label for="content" class="block mb-2">Content</label>
                    <textarea class="border rounded w-full p-2" id="modalContent" name="content" rows="5" required></textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update Post</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(post) {
            document.getElementById('modalTitle').value = post.title;
            document.getElementById('modalContent').value = post.content;
            document.getElementById('editForm').action = `/manage/${post.id}`;
            document.getElementById('editModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('editModal').style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('editModal')) {
                closeModal();
            }
        }
    </script>
</body>
</html>
