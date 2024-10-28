<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Dashboard</title>
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
            <a href="<?php echo e(route('user.dashboard')); ?>" class="text-white flex items-center hover:underline <?php echo e(request()->routeIs('user.dashboard') ? 'active' : ''); ?>">
                <i class="fas fa-user mr-1"></i>
                Profile
            </a>
            <a href="<?php echo e(route('posts.index')); ?>" class="text-white flex items-center hover:underline">
    <i class="fas fa-list mr-1"></i>
    All Posts
</a>

<a href="<?php echo e(route('posts.create')); ?>" class="text-white flex items-center hover:underline">
                <i class="fas fa-plus-circle mr-1"></i>
                Add Post
            </a>
            <a href="<?php echo e(route('manage.index')); ?>" class="text-white flex items-center hover:underline">
                <i class="fas fa-cogs mr-1"></i>
                Manage Post
            </a>
        </div>
        <div class="ml-auto">
            <span class="text-white mr-4">
                User: <?php echo e(Auth::user()->name); ?>

            </span>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="background-color: red; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">Logout</a>
<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
    <?php echo csrf_field(); ?>
</form>

        </div>
    </nav>
    <div class="max-w-4xl mx-auto p-4">
        <h1 class="text-4xl font-bold text-center mb-8">User Profile</h1>
        
        <div class="bg-blue-500 text-white p-4 rounded-t-lg">
            <h2 class="text-xl font-bold">Dashboard Statistics</h2>
        </div>
        <div class="bg-white shadow-md p-4 rounded-b-lg mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-green-500 text-white p-4 rounded-lg text-center">
        <h3 class="text-lg font-bold">Total Posts</h3>
        <p class="text-2xl mt-2"></p>
    </div>
    <div class="bg-yellow-500 text-white p-4 rounded-lg text-center">
        <h3 class="text-lg font-bold">Total Comments</h3>
        <p class="text-2xl mt-2"></p>
    </div>
    <div class="bg-teal-500 text-white p-4 rounded-lg text-center">
        <h3 class="text-lg font-bold">Approved Posts</h3>
        <p class="text-2xl mt-2"></p>
    </div>
</div>

        </div>
        
        <div class="bg-blue-500 text-white p-4 rounded-t-lg">
            <h2 class="text-xl font-bold">Profile Information</h2>
        </div>
        <div class="bg-white shadow-md p-4 rounded-b-lg">
            <p class="text-lg"><span class="font-bold">Name:</span> <?php echo e(Auth::user()->name); ?></p>
            <p class="text-lg"><span class="font-bold">Email:</span> <?php echo e(Auth::user()->email); ?></p>
        </div>
    </div>
    <div class="max-w-4xl mx-auto">
        <!-- Update Profile Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="bg-blue-600 text-white text-lg font-bold p-3 rounded-t-lg">
                Update Profile
            </div>
            <form action="<?php echo e(route('profile.update')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="mb-4">
        <label class="block text-gray-700">Name</label>
        <input type="text" name="name" class="w-full p-2 border border-gray-300 rounded" value="<?php echo e(Auth::user()->name); ?>">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Email</label>
        <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded" value="<?php echo e(Auth::user()->email); ?>">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Password</label>
        <input type="password" name="password" class="w-full p-2 border border-gray-300 rounded" placeholder="Leave blank to keep current password">
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded flex items-center">
        <i class="fas fa-save mr-2"></i> Update Profile
    </button>
</form>

        </div>

        <!-- Delete Account Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="bg-red-600 text-white text-lg font-bold p-3 rounded-t-lg">
                Delete Account
            </div>
            <p class="text-gray-700 mb-4">Are you sure you want to deactivate your account? This action cannot be undone.</p>
            <form action="<?php echo e(route('profile.deactivate')); ?>" method="POST" style="display: inline;">
    <?php echo csrf_field(); ?>
    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded flex items-center">
        <i class="fas fa-trash-alt mr-2"></i> Deactivate My Account
    </button>
</form>

        </div>

        <!-- Activity Logs Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="bg-blue-600 text-white text-lg font-bold p-3 rounded-t-lg">
                Activity Logs
            </div>
            <div class="p-6">
                <!-- Activity logs content goes here -->
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\abalo\midact3\resources\views/user/dashboard.blade.php ENDPATH**/ ?>