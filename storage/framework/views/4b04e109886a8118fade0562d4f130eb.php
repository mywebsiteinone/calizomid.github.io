<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
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
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-white flex items-center hover:underline">
                <i class="fas fa-home mr-1"></i>
                Dashboard
            </a>
            <a href="<?php echo e(route('abalos-users.index')); ?>" class="text-white flex items-center hover:underline active">
                <i class="fas fa-users mr-1"></i>
                Users
            </a>
            <a href="<?php echo e(route('abalos-categories.index')); ?>" class="text-white flex items-center hover:underline">
                <i class="fas fa-list mr-1"></i>
                Categories
            </a>
            <a href="<?php echo e(route('abalos-products.index')); ?>" class="text-white flex items-center hover:underline">
                <i class="fas fa-box mr-1"></i>
                Products
            </a>
            <a href="<?php echo e(route('abalos.chart')); ?>" class="text-white flex items-center hover:underline">
    <i class="fas fa-chart-line mr-1"></i>
    Reports
</a>
        </div>
        <div class="ml-auto flex items-center">
            <span class="text-white mr-4">
                Admin: <?php echo e(Auth::user()->name); ?>

            </span>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700 transition duration-300">
                Logout
            </a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>
        </div>
    </nav>  
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Users</h1>

        <!-- User Creation/Editing Form -->
        <h2 class="text-xl font-semibold mb-2"><?php echo e(isset($editUser) ? 'Edit User' : 'Create User'); ?></h2>
        <form action="<?php echo e(isset($editUser) ? route('abalos-users.update', $editUser->id) : route('abalos-users.store')); ?>" method="POST" class="bg-white p-4 rounded shadow-md mb-6">
            <?php echo csrf_field(); ?>
            <?php if(isset($editUser)): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo e(isset($editUser) ? $editUser->name : ''); ?>" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" placeholder="Enter user name">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo e(isset($editUser) ? $editUser->email : ''); ?>" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" placeholder="Enter user email">
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
                <?php echo e(isset($editUser) ? 'Update' : 'Create'); ?>

            </button>
        </form>

        <!-- Search Bar -->
        <div class="mb-4">
            <form action="<?php echo e(route('abalos-users.index')); ?>" method="GET" class="flex items-center">
                <input type="text" name="search" placeholder="Search by name" value="<?php echo e(request('search')); ?>" class="border border-gray-300 rounded-md p-2 w-full mr-2" />
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300">Search</button>
            </form>
        </div>

        <!-- User List -->
       <!-- User List -->
<h2 class="text-xl font-semibold mb-2">User List:</h2>
<?php if($users->count()): ?>
    <div class="table-container">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b"><?php echo e($user->name); ?></td>
                        <td class="py-2 px-4 border-b"><?php echo e($user->email); ?></td>
                        <td class="py-2 px-4 border-b">
                            <div class="flex space-x-2">
                                <a href="<?php echo e(route('abalos-users.edit', $user->id)); ?>" class="text-blue-500 hover:underline">Edit</a>
                                <form action="<?php echo e(route('abalos-users.destroy', $user->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination Controls -->
    <div class="mt-4 flex justify-between">
        <div>
            Showing <?php echo e($users->firstItem()); ?> to <?php echo e($users->lastItem()); ?> of <?php echo e($users->total()); ?> users
        </div>
        <div>
            <?php echo e($users->links()); ?>

        </div>
    </div>
<?php else: ?>
    <p class="mt-4 text-gray-600">No users found.</p>
<?php endif; ?>
<?php /**PATH C:\Users\chris\midtermact1\resources\views/abaloschristianuser.blade.php ENDPATH**/ ?>