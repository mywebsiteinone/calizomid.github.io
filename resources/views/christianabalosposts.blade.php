<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Posts</title>
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
<body class="bg-gray-100 flex flex-col min-h-screen">
    <nav class="bg-blue-500 p-4 flex items-center">
        <div class="text-white text-xl font-bold flex items-center">
            <i class="fas fa-tachometer-alt mr-2"></i>
            Dashboard
        </div>
        <div class="ml-8 flex space-x-4">
            <a href="{{ route('user.dashboard') }}" class="text-white flex items-center hover:underline">
                <i class="fas fa-user mr-1"></i>
                Profile
            </a>
            <a href="{{ route('posts.index') }}" class="text-white flex items-center hover:underline {{ request()->routeIs('posts.index') ? 'active' : '' }}">
                <i class="fas fa-list mr-1"></i>
                All Posts
            </a>
            <a href="{{ route('posts.create') }}" class="text-white flex items-center hover:underline">
                <i class="fas fa-plus-circle mr-1"></i>
                Add Post
            </a>
            <a href="{{ route('manage.index') }}" class="text-white flex items-center hover:underline">
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

    <main class="flex-grow flex items-center justify-center">
        <div class="container mx-auto p-6 bg-white rounded shadow">
            <h2 class="text-2xl font-bold mb-4 text-center">Posts</h2>
            @foreach($posts as $post)
                <div class="mb-6 border-b pb-4">
                    <h3 class="text-xl font-semibold">{{ $post->title }}</h3>
                    <p class="text-gray-700">{{ $post->content }}</p>
                    <p class="text-sm text-gray-500"><strong>Posted by:</strong> {{ $post->user->name }} <em>Posted on: {{ $post->created_at }}</em></p>
                    
                    <h4 class="mt-4 font-semibold">Comments</h4>
                    @foreach($post->comments as $comment)
                        <div class="text-gray-600 mb-2">
                            <strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}
                        </div>
                    @endforeach

                    <form action="{{ route('posts.comments.store', $post->id) }}" method="POST" class="mt-4">
                        @csrf
                        <textarea name="content" placeholder="Add a comment" required class="w-full border rounded p-2"></textarea>
                        <button type="submit" class="mt-2 bg-blue-500 text-white py-2 px-4 rounded">Comment</button>
                    </form>
                </div>
            @endforeach
        </div>
    </main>
</body>
</html>
