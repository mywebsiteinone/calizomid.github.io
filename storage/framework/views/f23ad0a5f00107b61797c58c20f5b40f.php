<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
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
            <a href="<?php echo e(route('abalos-users.index')); ?>" class="text-white flex items-center hover:underline">
                <i class="fas fa-users mr-1"></i>
                Users
            </a>
            <a href="<?php echo e(route('abalos-categories.index')); ?>" class="text-white flex items-center hover:underline active">
                <i class="fas fa-list mr-1"></i>
                Categories
            </a>
            <a href="<?php echo e(route('abalos-products.index')); ?>" class="text-white flex items-center hover:underline">
                <i class="fas fa-box mr-1"></i>
                Products
            </a>
            <a href="#" class="text-white flex items-center hover:underline">
                <i class="fas fa-chart-line mr-1"></i>
                Reports
            </a>
            <a href="<?php echo e(route('posts.home')); ?>" class="text-white flex items-center hover:underline">
    <i class="fas fa-cogs mr-1"></i>
    Manage Post
</a></div>
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
        <h1 class="text-2xl font-bold mb-4">Categories</h1>

        <!-- Category Creation/Editing Form -->
        <h2 class="text-xl font-semibold mb-2"><?php echo e(isset($editCategory) ? 'Edit Category' : 'Create Category'); ?></h2>
        <form action="<?php echo e(isset($editCategory) ? route('abalos-categories.update', $editCategory->id) : route('abalos-categories.store')); ?>" method="POST" class="bg-white p-4 rounded shadow-md mb-6">
            <?php echo csrf_field(); ?>
            <?php if(isset($editCategory)): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo e(isset($editCategory) ? $editCategory->name : ''); ?>" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" placeholder="Enter category name">
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
                <?php echo e(isset($editCategory) ? 'Update' : 'Create'); ?>

            </button>
        </form>

        <!-- Search Bar -->
        <div class="mb-4">
            <form action="<?php echo e(route('abalos-categories.index')); ?>" method="GET" class="flex items-center">
                <input type="text" name="search" placeholder="Search by name" value="<?php echo e(request('search')); ?>" class="border border-gray-300 rounded-md p-2 w-full mr-2" />
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300">Search</button>
            </form>
        </div>

        <!-- Category List -->
        <h2 class="text-xl font-semibold mb-2">Category List:</h2>
        <?php if($categories->count() > 0): ?>
            <div class="table-container">
                <table class="min-w-full bg-white rounded shadow-md">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-2 px-4 text-left">Name</th>
                            <th class="py-2 px-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b">
                                <td class="py-2 px-4"><?php echo e($category->name); ?></td>
                                <td class="py-2 px-4">
                                    <div class="flex space-x-2">
                                        <a href="<?php echo e(route('abalos-categories.edit', $category->id)); ?>" class="text-blue-500 hover:underline">Edit</a>
                                        <form action="<?php echo e(route('abalos-categories.destroy', $category->id)); ?>" method="POST" style="display:inline;">
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
                    Showing <?php echo e($categories->firstItem()); ?> to <?php echo e($categories->lastItem()); ?> of <?php echo e($categories->total()); ?> categories
                </div>
                <div>
                    <?php echo e($categories->links()); ?>

                </div>
            </div>
        <?php else: ?>
            <p class="mt-4 text-gray-600">No categories found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
<?php /**PATH C:\Users\abalo\midact3\resources\views/abaloschristiancategory.blade.php ENDPATH**/ ?>