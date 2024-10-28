<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
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
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-white flex items-center hover:underline <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                <i class="fas fa-home mr-1"></i>
                Dashboard
            </a>
            <a href="<?php echo e(route('abalos-users.index')); ?>" class="text-white flex items-center hover:underline">
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
        <div class="ml-auto">
            <span class="text-white mr-4">
                Admin: <?php echo e(Auth::user()->name); ?>

            </span>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="background-color: red; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">Logout</a>
<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
    <?php echo csrf_field(); ?>
</form>

        </div>
    </nav>
    <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between hover:shadow-lg transition-shadow duration-300">
            <div class="text-blue-500 text-4xl">
                <i class="fas fa-th-list"></i>
            </div>
            <div class="text-right">
                <div class="text-xl font-semibold">Total Categories</div>
                <div class="text-2xl"><?php echo e($totalCategories); ?></div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between hover:shadow-lg transition-shadow duration-300">
            <div class="text-green-500 text-4xl">
                <i class="fas fa-users"></i>
            </div>
            <div class="text-right">
                <div class="text-xl font-semibold">Total Users</div>
                <div class="text-2xl"><?php echo e($totalUsers); ?></div> 
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between hover:shadow-lg transition-shadow duration-300">
            <div class="text-yellow-500 text-4xl">
                <i class="fas fa-box"></i>
            </div>
            <div class="text-right">
                <div class="text-xl font-semibold">Total Products</div>
                <div class="text-2xl"><?php echo e($totalProducts); ?></div>
            </div>
        </div>
    </div>
    <div class="flex justify-center items-center h-screen"> 
        <div class="bg-white shadow-lg rounded-lg p-6 w-96">
            <div class="bg-blue-100 text-gray-700 p-4 rounded-md mb-4">
                Welcome Admin: <?php echo e(Auth::user()->name); ?>!
            </div>
            <div class="bg-blue-100 text-gray-700 p-4 rounded-md">
                <p>Your email:</p>
                <p><?php echo e(Auth::user()->email); ?></p>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\chris\midtermact1\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>